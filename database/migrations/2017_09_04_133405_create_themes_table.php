<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forum_id')->unsigned();
            $table->integer('client_id')->unsigned()->nullable();;
            $table->string('name', 255);
            $table->string('fake_name', 255)->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_enable');
            $table->text('description');
            $table->timestamps();

            $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
