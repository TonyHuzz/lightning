<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->comment('文章表');
            $table->id();
            $table->string('title')->comment('標題');
            $table->string('description')->comment('簡介');
            $table->text('content')->comment('內容');
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('visits')->default(0)->comment('訪客數');
            $table->boolean('is_published')->default(false)->comment('是否發布');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade')->comment('作者');
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
