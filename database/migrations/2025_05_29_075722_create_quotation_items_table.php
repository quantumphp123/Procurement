<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quotation_id');
            $table->unsignedBigInteger('enquiry_item_id');
            $table->string('item_name')->nullable();
            $table->string('quantity')->nullable();
            $table->text('remarks')->nullable();
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->decimal('total_price', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('quotation_id')->references('id')->on('quotations');
            $table->foreign('enquiry_item_id')->references('id')->on('enquiry_items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotation_items');
    }
};
