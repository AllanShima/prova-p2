<?php

namespace App\Services;

use App\Repositories\GenreRepository;
use App\Services\BookService;

class GenreService
{
    private GenreRepository $genreRepository;
    private BookService $bookService;

    public function __construct(GenreRepository $genreRepository, BookService $bookService)
    {
        $this->genreRepository = $genreRepository;
        $this->bookService = $bookService;
    }

    public function get()
    {
        $genre = $this->genreRepository->get();
        return $genre;
    }

    public function details(int $id)
    {
        return $this->genreRepository->details($id);
    }

    public function store(array $data)
    {
        return $this->genreRepository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->genreRepository->update($id, $data);
    }

    public function delete($id)
    {
        $genre = $this->details($id);
        $books = $genre->books;

        foreach($books as $book){
            $this->bookService->update($book->id, ["genre_id"=> null]); // Será feito somente o desveínculo
        }

        return $this->genreRepository->delete($id);
    }

    public function findBooks(int $id){
        return $this->genreRepository->findBooks($id);
    }

    public function getWithBooks(){
        return $this->genreRepository->getWithBooks();
    }
}