<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libraries extends Model
{
    protected $table ='libraries';

    protected $fillable=[
        'user_id',
        'title',
        'desc'
    ];
}
