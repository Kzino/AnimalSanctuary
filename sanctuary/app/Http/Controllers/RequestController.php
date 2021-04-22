<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Animal;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class RequestController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = null)
    {
        $animals = Animal::with('images')
                    ->join('requests', function($join)
                    {
                        $join->on('animals.id', '=', 'requests.animal_id');
                    })
                    ->where('requests.user_id', '=', DB::raw("'".Auth::id()."'"))
                    ->where(function($q) use ($status) {
                        $q->where(function($query) use ($status) {
                            $query->where(DB::raw("null"), '=', $status);
                        })
                        ->orWhere(function($query) use ($status) {
                            $query->where('requests.status', '=', $status);
                        });
                    })
                    ->get(['animals.*', 'requests.status as request_status', 'requests.created_at as request_created_at']);
        return view('request')->with(['animals' => json_decode($animals, true), 'status' => $status]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffRequest($type = null)
    {
        $animals = Animal::with('images')
            ->join('requests', function($join)
            {
                $join->on('animals.id', '=', 'requests.animal_id');
            })
            ->leftJoin('users', function($join)
            {
                $join->on('users.id', '=', 'requests.user_id');
            })
            ->where('requests.status', '<>', 'pending')
            ->where(function($q) use ($type) {
                $q->where(function($query) use ($type) {
                    $query->where(DB::raw("null"), '=', $type);
                })
                ->orWhere(function($query) use ($type) {
                    $query->where('animals.type', '=', $type);
                });
            })
            ->get([
                'animals.*', 
                'requests.status as request_status', 
                'requests.created_at as request_created_at',
                'users.name as request_user'
            ]);
        return view('staffRequest')->with(['animals' => json_decode($animals, true), 'type' => $type]);
    }

    public function accept(HttpRequest $request)
    {   
        return DB::transaction(function() use ($request) {
            try{
                $this->validateRequestAccept($request->all())->validate();
                request()->merge([
                    'status' => 'approved'
                ]);

                $this->updateRequest($request->all());

                $animal = Request::join('animals', function($join)
                            {
                                $join->on('animals.id', '=', 'requests.animal_id');
                            })
                            ->where('requests.id', '=', $request->id)
                            ->get(['animals.*', 'requests.id as request_id'])
                            ->first();

                Animal::where('id', $animal->id)->update(array('availability' => false));
                $status = "You have successfully approved adoption request for $animal->name.";
                return $request->wantsJson()
                    ? new JsonResponse(['animal' => $animal, 'status' => $status], 200) :
                    redirect(route('request'))->with('status', $status);
            }
            catch (\Exception $e) {
                return $request->wantsJson()
                    ? new JsonResponse(['error' => $e], 201) : redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        });
    }

    public function deny(HttpRequest $request)
    {   
        return DB::transaction(function() use ($request) {
            try{
                $this->validateRequestDeny($request->all())->validate();
                request()->merge([
                    'status' => 'denied'
                ]);

                $this->updateRequest($request->all());

                $animal = Request::join('animals', function($join)
                            {
                                $join->on('animals.id', '=', 'requests.animal_id');
                            })
                            ->where('requests.id', '=', $request->id)
                            ->get(['animals.*', 'requests.id as request_id'])
                            ->first();
                $status = "You have successfully denied adoption request for $animal->name.";
                return $request->wantsJson()
                    ? new JsonResponse(['animal' => $animal, 'status' => $status], 200) :
                    redirect(route('request'))->with('status', $status);
            }
            catch (\Exception $e) {
                return $request->wantsJson()
                    ? new JsonResponse(['error' => $e], 201) : redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        });
    }

    public function adopt(HttpRequest $request)
    {   
        $this->validateAnimal($request->all())->validate();
        return DB::transaction(function() use ($request) {
            try{
                request()->merge([
                    'user_id' => Auth::id(), 
                    'status' => 'pending'
                ]);

                $adoption = $this->createRequest($request->all());

                $animal = Request::join('animals', function($join)
                            {
                                $join->on('animals.id', '=', 'requests.animal_id');
                            })
                            ->where('requests.id', '=', $adoption->id)
                            ->get(['animals.*', 'requests.id as request_id'])
                            ->first();

                $status = "You have successfully requested to adopt $animal->name.";

                return $request->wantsJson()
                    ? new JsonResponse(['animal' => $animal, 'status' => $status], 200) :
                    redirect(route('request'))->with('status', $status);
            }
            catch (\Exception $e) {
                return $request->wantsJson()
                    ? new JsonResponse(['error' => $e], 201) : redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        });
    }

    /**
     * Get a validator for an incoming animal request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateAnimal(array $data)
    {
        return Validator::make($data, [
            'id' => ['required',
                Rule::exists('animals')
                    ->where('id', $data['id'])
                    ->where('availability', true),
            ],
        ]);
    }

    /**
     * Get a validator for an incoming animal request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateRequestAccept(array $data)
    {
        return Validator::make($data, [
            'id' => ['required',
                function ($attribute, $value, $fail) {
                    $count = Request::join('animals', function($join)
                {
                    $join->on('animals.id', '=', 'requests.animal_id');
                })
                ->where('animals.availability', true)
                ->where('requests.id', $value)->count();
                    if ($count === 0) {
                        return $fail('The '.$attribute.' is invalid.');
                    }
                }
                
            ],
        ]);
    }

    public function validateRequestDeny(array $data)
    {
        return Validator::make($data, [
            'id' => ['required',
                Rule::exists('requests')
                ->where('id', $data['id']),
            ],
        ]);
    }


    /**
     * Create a new request instance after a valid animal.
     *
     * @param  array  $data
     * @return \App\Models\Request
     */
    protected function createRequest(array $data)
    {
        return Request::updateOrCreate([
            'user_id' => $data['user_id'],
            'animal_id' => $data['id'],
        ],
        ['status' => $data['status']]);
    }


    /**
     * Update a request instance after a valid animal.
     *
     * @param  array  $data
     * @return \App\Models\Request
     */
    protected function updateRequest(array $data)
    {
        return Request::where('id', $data['id'])->update(array('status' => $data['status']));
    }

}
