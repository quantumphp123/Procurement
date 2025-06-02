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
        Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Foreign key to users table
        $table->string('company_name', 100);
        $table->string('license_number', 100);
        $table->string('vat_number', 100);
        $table->string('contact_person_name');
        $table->string('contact_person_designation');
        $table->string('file_path')->nullable(); //TODO: Need to remove this column
        $table->string('plans')->default('free'); // TODO: Need to remove this column

        $table->dateTime('otp_verified_at')->nullable();

        $table->timestamps(); // created_at & updated_at
        $table->softDeletes(); // deleted_at

        // Add unique constraints

        $table->unique('license_number');
        $table->unique('vat_number');

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
