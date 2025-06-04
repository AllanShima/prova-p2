<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use App\Services\AuthorService;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function get()
    {
        $author = $this->authorService->get();

        return AuthorResource::collection($author);
    }

    public function details($id)
    {
        try{
            $author = $this->authorService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Author not found', 404]);
        }
        return new AuthorResource($author);
    }

    public function store(AuthorStoreRequest $request)
    {
        $data = $request->validated(); // vai buscar todos os dados na requisição
        $author = $this->authorService->store($data);

        return new AuthorResource($author);
    }

    public function update(int $id, AuthorUpdateRequest $request){
        $data = $request->all();
        try{
            $author = $this->authorService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Author not found', 404]);
        }

        return new AuthorResource($author);
    }

    public function delete($id){
        try{
            $author = $this->authorService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Author not found', 404]);
        }
        return new AuthorResource($author);
    }

    public function findBooks(int $id){
        try{
            $author = $this->authorService->findBooks($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Author not found', 404]);
        }
        return BookResource::collection($author);
    }

    public function getWithBooks(){
        $authors = $this->authorService->getWithBooks();

        return AuthorResource::collection($authors);
    }
}
