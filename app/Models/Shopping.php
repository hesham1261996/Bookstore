<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User ;

class Shopping extends Model
{
    use HasFactory;
    protected $table = 'book-user' ; 

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function books(){
        return $this->belongsTo(Book::class);
    }
}
