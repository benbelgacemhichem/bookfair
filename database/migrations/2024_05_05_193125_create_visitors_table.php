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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->foreignId('book_id')->nullable()->constrained('books')->onDelete('cascade');
            $table->enum('type', ['Book', 'Bag']);
            $table->enum('bag_style', ['Bag 1', 'Bag 2', 'Bag 3', 'Bag 4'])->nullable();
            $table->longText('bag_content')->nullable();
            $table->enum('status', ['submitted','printing', 'printed', 'delivered', 'canceled'])->default('submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
