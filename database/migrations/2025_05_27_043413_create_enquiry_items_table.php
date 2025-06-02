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
        Schema::create('enquiry_items', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('enquiry_id');
                $table->foreignId('category_id')->constrained('categories');
                $table->text('item_description')->nullable();
                $table->string('manufacturer')->nullable();
                $table->unsignedInteger('qty')->nullable();
                $table->text('remark')->nullable();
                $table->dateTime('delivery_date')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
                });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry_items');
    }
};
