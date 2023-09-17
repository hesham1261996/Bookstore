<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publisher ;
use App\Models\Category ;
use App\Models\Author;
use App\Models\Rating;

class Book extends Model
{
    use HasFactory;

    public function publisher(){
        return $this->belongsTo(Publisher::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function authors(){
        return $this->belongsToMany(Author::class , 'book_author'); 
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function rate(){
        return $this->ratings->isNotEmpty() ? $this->ratings()->sum('value') / $this->ratings()->count() : 0 ; 
    }
}
