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
            $table->unsignedBigInteger('unit_id')->nullable()->after('manufacturer');
            $table->string('data_sheet')->nullable()->after('unit_id');
            
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('data_sheet');
            $table->boolean('drafted')->default(false)->after('status');

            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enquiry_items', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn(['unit_id', 'data_sheet', 'status', 'drafted']);
        });
    }
};
