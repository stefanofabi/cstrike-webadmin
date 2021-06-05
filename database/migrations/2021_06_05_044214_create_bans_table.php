<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('steam_id');
            $table->string('ip');
            $table->timestamp('expiration');
            $table->string('reason');
            $table->string('private_notes');
            
            $table->unsignedBigInteger('administrator_id')->nullable();
            $table->unsignedBigInteger('server_id');

            $table->unique(['steam_id', 'server_id']);
            $table->unique(['ip', 'server_id']);

            // Foreign keys
            $table->foreign('administrator_id')->references('id')->on('administrators')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('bans');
    }
}
