<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('bookId');
            $table->string('title');
            $table->longText('desc');
            $table->string('isbn');
            $table->string('author');
            $table->string('genre');
            // $table->string('review');
            // $table->string('rating');
            $table->string('publisher');
            $table->string('publish_date');
            $table->string('cover');
            $table->string('ebook');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
