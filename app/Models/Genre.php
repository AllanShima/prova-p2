<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Book;

class Genre extends Model
{
    protected $table = 'genres';
    protected $fillable = ['name'];

    public function books(){
        return $this->hasMany(Book::class,'genre_id','id');
    }
}
