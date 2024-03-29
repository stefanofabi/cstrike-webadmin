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
            $table->enum('status', ['Active', 'Expired', 'Suspended']);

            $table->unsignedBigInteger('rank_id');
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();

            $table->dateTime('suspended')->nullable();

            // Unique keys
            $table->unique(['auth', 'server_id']);

            // Foreign keys
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');

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
