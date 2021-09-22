<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Authors;

class Book extends Model
{
    protected $table = "book";
    protected $fillable = ['title', 'description', 'author', 'publisher', 'date_of_issue'];
    public function book()
    {
        return $this;
    }
}