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
        Schema::create('rooms', function (Blueprint $table) {

            $table->string('id')->unique()->primary();
            $table->string('name');
            $table->string('password')->nullable();
            $table->integer('user_id1');
            $table->string('role_user1');
            $table->integer('user_id2')->nullable();
            $table->string('role_user2');
            $table->string('status_user2');
            $table->integer('admin_id');
            $table->string('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
