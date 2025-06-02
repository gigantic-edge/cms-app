<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    // 
    protected $table = 'blogs';
    protected $fillable = [
    'title',
    'slug',
    'description',
    'image',
    'ranking',
    'created_by'
];

}
