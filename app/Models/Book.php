<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Author;
Use App\Models\Genre;
Use App\Models\Review;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['title','synopsis', 'author_id', 'genre_id'];

    public function reviews(){
        return $this->hasMany(Review::class,'book_id','id');
    }
    public function author(){
        return $this->belongsTo(Author::class,'author_id','id');
    }
    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id','id');
    }
}
