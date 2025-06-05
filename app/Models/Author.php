<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Métodos que ajudam no delete em cascata

use Illuminate\Database\Eloquent\Model;
Use App\Models\Book;

class Author extends Model
{
    use HasFactory;
    
    protected $table = 'authors';
    protected $fillable = ['name','date_of_birth', 'biography'];

    public function books(){
        return $this->hasMany(Book::class,'author_id','id');
    }

    protected static function booted()
    {
        static::deleting(function ($author) {
            // Isso deletará automaticamente todas os livros quando o author for deletado
            $author->books()->delete();
        });
    }
}
