<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// -----------------------------------------------------------
// Coleções de Rotas

Route::controller(UserController::class)->group(function (){
    Route::get('/users/reviews/{id}', 'findReview'); // Rota para listar review de um usuário

    Route::get('/users', 'get'); // Rota pra Listar
    Route::post('/users', 'store'); // Rota pra Criar
    Route::get('/users/{id}', 'details'); // Rota pra Listar com ID
    Route::patch('/users/{id}', 'update'); // Rota pra Atualizar
    Route::delete('/users/{id}', 'delete'); // Rota pra Deletar
}); 

Route::controller(BookController::class)->group(function(){
    Route::get('/books/reviews/{id}', 'findReviews'); // Rota para listar todas reviews de um livro
    Route::get('/books/reviews/authors/genres', [BookController::class, 'getWithDetails']); // Rota para listar livros com seus reviews, autor e genero
    
    Route::get('/books', 'get'); // Rota pra Listar
    Route::post('/books', 'store'); // Rota pra Criar
    Route::get('/books/{id}', 'details'); // Rota pra Listar com ID
    Route::patch('/books/{id}', 'update'); // Rota pra Atualizar
    Route::delete('/books/{id}', 'delete'); // Rota pra Deletar
});

Route::controller(AuthorController::class)->group(function(){
    Route::get('/authors/books/{id}', 'findBooks'); // Rota para listar todos os livros de um autor
    Route::get('/authors/books', [AuthorController::class, 'getWithBooks']); // Rota para listar autores com seus livros

    Route::get('/authors', 'get'); // Rota pra Listar
    Route::post('/authors', 'store'); // Rota pra Criar
    Route::get('/authors/{id}', 'details'); // Rota pra Listar com ID
    Route::patch('/authors/{id}', 'update'); // Rota pra Atualizar
    Route::delete('/authors/{id}', 'delete'); // Rota pra Deletar
});

Route::controller(GenreController::class)->group(function(){
    Route::get('/genres/books/{id}', 'findBooks'); // Rota para listar todos os livros de um gênero
    Route::get('/genres/books', [GenreController::class, 'getWithBooks']); // Rota para listar todos os gêneros com seus livros

    Route::get('/genres', 'get'); // Rota pra Listar
    Route::post('/genres', 'store'); // Rota pra Criar
    Route::get('/genres/{id}', 'details'); // Rota pra Listar com ID
    Route::patch('/genres/{id}', 'update'); // Rota pra Atualizar
    Route::delete('/genres/{id}', 'delete'); // Rota pra Deletar
});

Route::controller(ReviewController::class)->group(function(){
    Route::get('/reviews', 'get'); // Rota pra Listar
    Route::post('/reviews', 'store'); // Rota pra Criar
    Route::get('/reviews/{id}', 'details'); // Rota pra Listar com ID
    Route::patch('/reviews/{id}', 'update'); // Rota pra Atualizar
    Route::delete('/reviews/{id}', 'delete'); // Rota pra Deletar
});