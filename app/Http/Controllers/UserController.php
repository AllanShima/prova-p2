<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\ReviewResource;
use App\Services\UserService;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function get()
    {
        $user = $this->userService->get();

        return UserResource::collection($user);
    }

    public function details($id)
    {
        try{
            $user = $this->userService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }
        return new UserResource($user);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated(); // vai buscar todos os dados na requisição
        $user = $this->userService->store($data);

        return new UserResource($user);
    }

    public function update(int $id, UserUpdateRequest $request){
        $data = $request->all();
        try{
            $user = $this->userService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }

        return new UserResource($user);
    }

    public function delete($id){
        try{
            $user = $this->userService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }
        return new UserResource($user);
    }

    public function findReview(int $id){
        try{
            $reviews = $this->userService->findReview($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found', 404]);
        }
        return ReviewResource::collection($reviews);
    }
}
