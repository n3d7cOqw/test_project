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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->string("name", 256);
            $table->string("photo", 256)->nullable();
            $table->string("home_page", 256)->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string("captcha", 256);
            $table->mediumText("text");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
