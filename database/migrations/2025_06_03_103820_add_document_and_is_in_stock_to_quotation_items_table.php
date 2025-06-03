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
        Schema::table('quotation_items', function (Blueprint $table) {
            $table->string('document')->nullable()->after('total_price');
            $table->boolean('is_in_stock')->default(true)->after('document');
        });
    }

    public function down()
    {
        Schema::table('quotation_items', function (Blueprint $table) {
            $table->dropColumn(['document', 'is_in_stock']);
        });
    }
};
