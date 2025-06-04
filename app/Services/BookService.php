<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Services\ReviewService;

class BookService
{
    private BookRepository $bookRepository;
    private ReviewService $reviewService;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
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
        $book = $this->details($id);
        $reviews = $book->reviews;

        foreach($reviews as $review){
            $this->reviewService->update($review->id, ["book_id"=> null]);
        }

        return $this->bookRepository->delete($id);
    }

    public function findReviews(int $id){
        return $this->bookRepository->findReviews($id);
    }

    public function getWithDetails(){
        return $this->bookRepository->getWithDetails();
    }
}