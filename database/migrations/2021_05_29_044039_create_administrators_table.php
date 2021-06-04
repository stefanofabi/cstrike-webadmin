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
            $table->string('password');
            $table->string('account_flags');

            $table->date('expiration')->nullable();

            $table->unsignedBigInteger('rank_id');

            // Unique keys
            $table->unique('auth');

            // Foreign keys
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('restrict')->onUpdate('cascade');

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
