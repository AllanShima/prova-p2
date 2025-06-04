<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\User2;
Use App\Models\Book;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['rating','text', 'user_id', 'book_id'];

    public function user(){
        return $this->belongsTo(User2::class,'user_id','id');
    }
    public function book(){
        return $this->belongsTo(Book::class,'book_id','id');
    }
}
