<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Services\ReviewService;

class UserService
{
    private UserRepository $userRepository;
    private ReviewService $reviewService;

    public function __construct(UserRepository $userRepository, ReviewService $reviewService)
    {
        $this->userRepository = $userRepository;
        $this->reviewService = $reviewService;
    }

    public function get()
    {
        $user = $this->userRepository->get();
        return $user;
    }

    public function details(int $id)
    {
        return $this->userRepository->details($id);
    }

    public function store(array $data)
    {
        return $this->userRepository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function delete($id)
    {
        $user = $this->details($id);
        $reviews = $user->reviews;

        foreach($reviews as $review){
            $this->reviewService->update($review->id, ["user_id"=> null]);
        }

        return $this->userRepository->delete($id);
    }

    public function findReview(int $id){
        return $this->userRepository->findReview($id);
    }
}