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
        Schema::table('enquiry_items', function (Blueprint $table) {
            $table->boolean('request_data_sheet')->default(false)->after('data_sheet');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiry_items', function (Blueprint $table) {
            $table->dropColumn('request_data_sheet');
        });
    }
}; 