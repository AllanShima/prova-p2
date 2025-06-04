<?php

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository
{
    public function get(){
        return Genre::all();
    }

    public function details(int $id)
    {
        return Genre::find($id);
    }
    
    public function store(array $data)
    {
        return Genre::create($data);
    }

    public function update(int $id, array $data)
    {
        $genre = Genre::find($id);
        if($genre) {
            $genre->update($data);
        }
        return $genre;
    }

    public function delete(int $id)
    {
        $genre = Genre::find($id);
        if($genre) {
            $genre->delete();
        }
        return $genre;
    }

    public function findBooks(int $id){
        $genre = $this->details($id);
        return $genre->books;
    }

    public function getWithBooks(){
        return Genre::with('books')->get();
    }
}