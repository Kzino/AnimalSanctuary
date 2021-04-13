<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index($type = null)
    {
        $animals = Animal::with('images')
                    ->leftJoin('requests', function($join)
                    {
                        $join->on('animals.id', '=', 'requests.animal_id');
                        $join->on('requests.user_id','=', DB::raw("'".Auth::id()."'"));
                    })
                    ->where('animals.availability', '=', true)
                    ->where('requests.status', '=', NULL)
                    ->where(function($q) use ($type) {
                        $q->where(function($query) use ($type) {
                            $query->where(DB::raw("null"), '=', $type);
                        })
                        ->orWhere(function($query) use ($type) {
                            $query->where('animals.type', '=', $type);
                        });
                    })
                    ->get(['animals.*', 'requests.status as request_status']);
        return view('home')->with(['animals' => json_decode($animals, true), 'type' => $type]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function staffHome()
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
                ->where('availability', '=', 1)
                ->where('requests.status', '=', 'pending')
                ->get([
                    'animals.*', 
                    'requests.id as request_id', 
                    'requests.created_at as request_created_at',
                    'users.name as request_user'
                ]);
        return view('staffHome')->with('animals', json_decode($animals, true));
    }
}
