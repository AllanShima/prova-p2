<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {

            // 2. Quando um livro for apagado, todas as suas reviews devem ser apagadas também
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users2")->onDelete('cascade');

            // 3. Quando um usuário for apagado, todas as suas reviews devem ser apagadas
            $table->unsignedBigInteger("book_id")->nullable();
            $table->foreign("book_id")->references("id")->on("books")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
