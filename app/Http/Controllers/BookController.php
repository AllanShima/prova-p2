<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ReviewResource;
use App\Services\BookService;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function get()
    {
        $book = $this->bookService->get();

        return BookResource::collection($book);
    }

    public function details($id)
    {
        try{
            $book = $this->bookService->details($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found', 404]);
        }
        return new BookResource($book);
    }

    public function store(BookStoreRequest $request)
    {
        $data = $request->validated(); // vai buscar todos os dados na requisição
        $book = $this->bookService->store($data);

        return new BookResource($book);
    }

    public function update(int $id, BookUpdateRequest $request){
        $data = $request->all();
        try{
            $book = $this->bookService->update($id,$data);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found', 404]);
        }

        return new BookResource($book);
    }

    public function delete($id){
        try{
            $book = $this->bookService->delete($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found', 404]);
        }
        return new BookResource($book);
    }

    public function findReviews(int $id){
        try{
            $books = $this->bookService->findReviews($id);
        }
        catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found', 404]);
        }
        return ReviewResource::collection($books);
    }

    public function getWithDetails(){
        $books = $this->bookService->getWithDetails();

        return BookResource::collection($books);
    }
}
