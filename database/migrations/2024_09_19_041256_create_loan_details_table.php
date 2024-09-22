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
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'loan_id')->constrained();
            $table->foreignId(column: 'book_id')->constrained();
            $table->string('invoice', length: 20);
            $table->date('returned_at')->nullable();
            $table->enum('status', ['0', '1', '2', '3', '4']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_details');
    }
};
