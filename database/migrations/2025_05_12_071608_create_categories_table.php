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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT (Primary Key)
            $table->string('name'); // VARCHAR(255) NOT NULL
            $table->string('image')->nullable(); // VARCHAR(255) NULLABLE
            $table->string('title')->nullable(); // VARCHAR(255) NULLABLE
            $table->text('description')->nullable(); // TEXT NULLABLE
            $table->timestamps(0); // Created_at, Updated_at (TIMESTAMP NULL DEFAULT NULL)
            $table->softDeletes(); // Deleted_at (TIMESTAMP NULL DEFAULT NULL)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
