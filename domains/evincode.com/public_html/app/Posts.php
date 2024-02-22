<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //
    protected $fillable = [
        'name', 'price', 'note1','note2','note3','detail','image'
    ];

    protected $table = 'products';
}
