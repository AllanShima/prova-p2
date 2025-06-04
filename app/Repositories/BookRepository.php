<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function get(){
        return Book::all();
    }

    public function details(int $id)
    {
        return Book::find($id);
    }
    
    public function store(array $data)
    {
        return Book::create($data);
    }

    public function update(int $id, array $data)
    {
        $book = Book::find($id);
        if($book) {
            $book->update($data);
        }
        return $book;
    }

    public function delete(int $id)
    {
        $book = Book::find($id);
        if($book) {
            $book->delete();
        }
        return $book;
    }

    public function findReviews(int $id){
        $book = $this->details($id);
        return $book->reviews;
    }

    public function getWithDetails(){
        return Book::with(['author', 'genre', 'reviews'])->get();
    }
}