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
        Schema::create('enquiry_seller', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->constrained('enquiries')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'quoted', 'declined', 'accepted'])->default('pending');
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            // Ensure unique combination
            $table->unique(['enquiry_id', 'seller_id']);

            // Add indexes for better performance
            $table->index(['seller_id', 'status']);
            $table->index(['enquiry_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_seller');
    }
};
