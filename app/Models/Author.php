<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Book;

class Author extends Model
{
    protected $table = 'authors';
    protected $fillable = ['name','date_of_birth', 'biography'];

    public function books(){
        return $this->hasMany(Book::class,'author_id','id');
    }
}
