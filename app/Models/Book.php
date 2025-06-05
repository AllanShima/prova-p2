<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Facilita ao apagar outros dados em cascata

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

Use App\Models\Author;
Use App\Models\Genre;
Use App\Models\Review;

class Book extends Model
{
    use HasFactory;

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

    protected static function booted()
    {
        static::deleting(function ($book) {
            // Isso deletará automaticamente todas as reviews quando o livro for deletado
            $book->reviews()->delete();
        });
    }
}
