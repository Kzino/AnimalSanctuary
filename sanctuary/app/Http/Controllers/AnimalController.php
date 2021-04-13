<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function staffAnimal()
    {
        $animals = Animal::with('images')
                    ->leftJoin('requests', function($join)
                    {
                        $join->on('animals.id', '=', 'requests.animal_id');
                        $join->where('requests.status', '=', 'approved');
                    })
                    ->leftJoin('users', function($join)
                    {
                        $join->on('requests.user_id', '=', 'users.id');
                    })
                    ->get(['animals.*', 'users.name as owner']);
        return view('staffAnimal')->with('animals', json_decode($animals, true));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function staffAnimalAdd()
    {
        return view('staffAnimalAdd');
    }

    public function store(Request $request)
    {   
        $this->validator($request->all())->validate();
        return DB::transaction(function() use ($request) {
            try{
                $animal = $this->create($request->all());

                $image_service = new ImageController();

                $image_service->storeAnimalImages($request, $animal);

                return redirect(route('staff.animal_add'))->with('status', "$animal->name was successfully added.");
            }
            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        });
    }


    /**
     * Get a validator for an incoming animal request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:200'],
            'date_of_birth' => ['required', 'date', 'before:tomorrow'],
            'type' => ['required', 'in:cat,dog'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif']
        ]);
    }

    /**
     * Create a new user instance after a valid animal.
     *
     * @param  array  $data
     * @return \App\Models\Animal
     */
    protected function create(array $data)
    {
        return Animal::create([
            'name' => $data['name'],
            'date_of_birth' => $data['date_of_birth'],
            'description' => $data['description'],
            'type' => $data['type']
        ]);
    }
}
