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
        Schema::create('game_chats', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date')->default(DB::raw('NOW()'));
            $table->string('name');
            $table->string('message');
            $table->string('team');
            $table->boolean('alive');
            $table->unsignedBigInteger('server_id');

            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade')->onUpdate('cascade');
            
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_chats');
    }
};
