<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publisher ;
use App\Models\Category ;
use App\Models\Author;

class Book extends Model
{
    use HasFactory;

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function authers(){
        return $this->belongsToMany(Author::class , 'book_author'); 
    }
}
