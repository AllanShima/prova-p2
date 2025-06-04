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
        Schema::table('books', function (Blueprint $table) {

            // 5. Quando um autor for apagado, os livros relacionados devem ser apagados
            $table->unsignedBigInteger("author_id")->nullable();
            $table->foreign("author_id")->references("id")->on("authors")->onDelete('cascade');

            // 4. Quando um Gênero for apagado, os livros relacionados devem ser desvinculados
            $table->unsignedBigInteger("genre_id")->nullable();
            $table->foreign("genre_id")->references("id")->on("genres")->onDelete('set null');
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
