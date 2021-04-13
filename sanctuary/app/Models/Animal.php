<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use Carbon\Carbon;

class Animal extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date_of_birth',
        'description',
        'type',
        'availability'
    ];

    protected $attributes = [ 
        'availability' => true
    ];
    
    public function images(){
        return $this->hasMany(Image::class);
    }

    public function getDateOfBirthAttribute()
    {
        $age = Carbon::parse($this->attributes['date_of_birth'])->age;
        return  Carbon::parse($this->attributes['date_of_birth'])->format("jS M Y") . " (" . $age . " year".($age>1?'s':'').")";
    }

    public function getCreatedAtAttribute()
    {
        return  Carbon::parse($this->attributes['created_at'])->diffForhumans();
    }
}
