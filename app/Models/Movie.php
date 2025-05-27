<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'year',
        'cover_image',
        'synopsis',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);


    }
    // app/Models/Movie.php


}
