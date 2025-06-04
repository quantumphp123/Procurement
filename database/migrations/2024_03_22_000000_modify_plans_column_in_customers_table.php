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
        Schema::table('customers', function (Blueprint $table) {
            // First drop the default value
            $table->string('plans')->default(null)->change();
            // Then make it nullable
            $table->string('plans')->nullable()->change();
            // Add plan expiration column
            $table->timestamp('plan_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('plans')->default('free')->change();
            $table->dropColumn('plan_expires_at');
        });
    }
};
