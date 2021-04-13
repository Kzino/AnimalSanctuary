<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /***
     * php artisan storage:link
     */
    public function storeAnimalImages(Request $request, Animal $animal)
    {
        $this->validator($request->all())->validate();
        if ($request->hasfile('images')) {
            $images = $request->file('images');
            foreach($images as $image) {

                $name = $image->getClientOriginalName(); 
                $key = implode('.', [
                    md5_file($image->getPathname()),
                    $image->getClientOriginalExtension()
                ]);
                $path = $image->storeAs('uploads', $key, 'public');
                $this->create([
                    'name' => $name,
                    'key' => $key,
                    'path' => $path,
                    'animal_id' => $animal->id
                ]);
            }
        }
        else{
            dd($request->all());
        }
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
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif']
        ]);
    }

    /**
     * Create a new user instance after a valid animal.
     *
     * @param  array  $data
     * @return \App\Models\Image
     */
    protected function create(array $data)
    {
        return Image::create([
            'name' => $data['name'],
            'key' => $data['key'],
            'path' => '/storage/' . $data['path'],
            'animal_id' => $data['animal_id']
        ]);
    }
}
