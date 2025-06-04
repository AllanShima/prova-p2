<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Book;

class AuthorRepository
{
    public function get(){
        return Author::all();
    }

    public function details(int $id)
    {
        return Author::find($id);
    }
    
    public function store(array $data)
    {
        return Author::create($data);
    }

    public function update(int $id, array $data)
    {
        $author = Author::find($id);
        if($author) {
            $author->update($data);
        }
        return $author;
    }

    public function delete(int $id)
    {
        $author = Author::find($id);
        if($author) {
            $author->delete();
        }
        return $author;
    }

    public function findBooks(int $id){
        $author = $this->details($id);
        return $author->books;
    }

    public function getWithBooks(){
        return Author::with('books')->get();
    }
}