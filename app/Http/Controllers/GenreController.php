<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;
use App\Http\Resources\GenreResource;
use App\Http\Resources\BookResource;
use App\Services\GenreService;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class GenreController extends Controller
{
    private GenreService $genreService;

    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }

    public function get()
    {
        $genre = $this->genreService->get();

        return GenreResource::collection($genre);
    }

    public function details($id)
    {
        try{
            $genre = $this->genreService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }
        return new GenreResource($genre);
    }

    public function store(GenreStoreRequest $request)
    {
        $data = $request->validated(); // vai buscar todos os dados na requisição
        $genre = $this->genreService->store($data);

        return new GenreResource($genre);
    }

    public function update(int $id, GenreUpdateRequest $request){
        $data = $request->validated();
        try{
            $genre = $this->genreService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }

        return new GenreResource($genre);
    }

    public function delete($id){
        try{
            $genre = $this->genreService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }
        return new GenreResource($genre);
    }

    public function findBooks(int $id){
        try{
            $genres = $this->genreService->findBooks($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Genre not found', 404]);
        }
        return BookResource::collection($genres);
    }

    public function getWithBooks(){
        $genre = $this->genreService->getWithBooks();
        
        return GenreResource::collection($genre);
    }
}
