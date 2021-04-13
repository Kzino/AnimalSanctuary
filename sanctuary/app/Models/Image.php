<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Animal;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'path', 'key', 'animal_id'
    ];

    public function animal(){
        return $this->belongsTo(Animal::class);
    }
}
