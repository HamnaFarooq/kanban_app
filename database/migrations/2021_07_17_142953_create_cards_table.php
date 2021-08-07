<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mylist_id')->references('id')->on('mylists')->onDelete('cascade');
            $table->string('title')->unique();
            $table->string('description');
            // $table->binary('attachment');
            $table->boolean('completed');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE cards ADD attachment LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
