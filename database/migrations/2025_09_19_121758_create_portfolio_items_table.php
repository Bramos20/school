<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('portfolio_items', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('item_type', ['file', 'link']);
            $table->string('file_path')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};
