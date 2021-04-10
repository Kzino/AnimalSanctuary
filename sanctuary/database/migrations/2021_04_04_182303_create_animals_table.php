<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->date('date_of_birth');
            $table->string('description', 200);
            $table->string('picture');
            $table->boolean('availability');
            $table->boolean('vaccinated');
            $table->boolean('trained');
            $table->enum('category', ['cats', 'dogs']);
            $table->string('colour');
            $table->string('breed');
            $table->string('location');
            $table->string('email');
            
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
        Schema::dropIfExists('animals');
    }
}
