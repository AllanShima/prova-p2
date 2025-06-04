<?php

namespace App\Repositories;

use App\Models\User2;

class UserRepository
{
    public function get(){
        return User2::all();
    }

    public function details(int $id)
    {
        return User2::find($id);
    }
    
    public function store(array $data)
    {
        return User2::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User2::find($id);
        if($user) {
            $user->update($data);
        }
        return $user;
    }

    public function delete(int $id)
    {
        $user = User2::find($id);
        if($user) {
            $user->delete();
        }
        return $user;
    }

    public function findReview(int $id){
        $user = $this->details($id);
        return $user->reviews;
    }
}