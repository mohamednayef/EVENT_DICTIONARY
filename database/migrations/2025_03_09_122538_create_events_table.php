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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('category',['concert','theater','sports','conference'])->default('concert');
            $table->string('name');
            $table->text('description');
            $table->date('date');
            $table->text('location');
            $table->unsignedBigInteger('capacity');
            $table->unsignedBigInteger('available_tickets');
            $table->decimal('price');
            $table->text('image_path')->default("http://localhost:8000/storage/event/default.jpg");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
