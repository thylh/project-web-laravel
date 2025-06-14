<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // lecture, exercise, etc
            $table->text('description')->nullable();
            $table->string('file_path'); // lưu tên file
            $table->unsignedBigInteger('file_size')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // nếu có liên kết với người dùng
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
