<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table= 'book';

    protected $fillable=[
        'user_id',
        'libraries_id',
        'title'
    ];
}
