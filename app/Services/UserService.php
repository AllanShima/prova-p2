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
        return $this->userRepository->delete($id); // O método Eloquent cuida do resto pra apagar (Comportamento 2)
    }

    public function findReview(int $id){
        return $this->userRepository->findReview($id);
    }
}