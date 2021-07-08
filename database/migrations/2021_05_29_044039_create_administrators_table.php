<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('auth');
            $table->string('password')->nullable();
            $table->string('account_flags');

            $table->date('expiration')->nullable();

            $table->unsignedBigInteger('rank_id');
            $table->unsignedBigInteger('user_id')->nullable();

            // Unique keys
            $table->unique('auth');

            // For simplicity, only one administrator per user account will be allowed
            $table->unique('user_id');        

            // Foreign keys
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');

            $table->timestamps();
            
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
