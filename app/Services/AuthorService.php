<?php

namespace App\Services;

use App\Repositories\AuthorRepository;
use App\Services\BookService;

class AuthorService
{
    private AuthorRepository $authorRepository;
    private BookService $bookService;

    public function __construct(AuthorRepository $authorRepository, BookService $bookService)
    {
        $this->authorRepository = $authorRepository; 
        $this->bookService = $bookService; 
    }

    public function get()
    {
        $book = $this->authorRepository->get();
        return $book;
    }

    public function details(int $id)
    {
        return $this->authorRepository->details($id);
    }

    public function store(array $data)
    {
        return $this->authorRepository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->authorRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->authorRepository->delete($id); // O método Eloquent cuida do resto pra apagar (Comportamento 5)
    }

    public function findBooks(int $id){
        return $this->authorRepository->findBooks($id);
    }

    public function getWithBooks(){
        return $this->authorRepository->getWithBooks();
    }
}