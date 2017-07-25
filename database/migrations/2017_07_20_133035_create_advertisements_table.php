<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->engine = 'myISAM';

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->text('description');
            $table->text('tags');
            $table->float('price', 10, 2);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('user_id')->references('id')->on('users');
        });

        DB::statement('ALTER TABLE advertisements ADD FULLTEXT search(title, description, tags)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisements', function($table) {
            $table->dropIndex('search');
        });
        Schema::dropIfExists('advertisements');
    }
}
