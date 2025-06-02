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
            // Drop existing columns if they exist
            if (Schema::hasColumn('customers', 'trial_starts_at')) {
                $table->dropColumn('trial_starts_at');
            }
            if (Schema::hasColumn('customers', 'trial_ends_at')) {
                $table->dropColumn('trial_ends_at');
            }
            if (Schema::hasColumn('customers', 'plan_expires_at')) {
                $table->dropColumn('plan_expires_at');
            }

            // Add columns with proper timestamp type
            $table->timestamp('trial_starts_at')->useCurrent();
            $table->timestamp('trial_ends_at')->useCurrent();
            $table->timestamp('plan_expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['trial_starts_at', 'trial_ends_at', 'plan_expires_at']);
        });
    }
};
