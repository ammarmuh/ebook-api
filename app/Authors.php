<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = "author";
    protected $fillable = ['name', 'date_of_birth', 'place_of_birth', 'gender', 'email', 'hp'];
}
