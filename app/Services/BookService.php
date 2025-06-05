<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Services\ReviewService;

class BookService
{
    private BookRepository $bookRepository;
    private ReviewService $reviewService;

    public function __construct(BookRepository $bookRepository, ReviewService $reviewService)
    {
        $this->bookRepository = $bookRepository;
        $this->reviewService = $reviewService;
    }

    public function get()
    {
        $book = $this->bookRepository->get();
        return $book;
    }

    public function details(int $id)
    {
        return $this->bookRepository->details($id);
    }

    public function store(array $data)
    {
        return $this->bookRepository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->bookRepository->delete($id); // O método Eloquent cuida do resto pra apagar (Comportamento 2)
    }

    public function findReviews(int $id){
        return $this->bookRepository->findReviews($id);
    }

    public function getWithDetails(){
        return $this->bookRepository->getWithDetails();
    }
}