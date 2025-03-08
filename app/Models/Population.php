<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    protected $fillable = ['year', 'prefecture', 'population'];
    protected $table = 'population';

}
