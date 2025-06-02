<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enquiry_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enquiry_id');
            $table->unsignedBigInteger('category_id');
            $table->text('item_description');
            $table->string('manufacturer')->nullable();
            $table->unsignedInteger('quantity');
            $table->text('remark')->nullable();
            $table->datetime('delivery_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->index(['enquiry_id']);
            $table->index(['category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('enquiry_items');
    }
};
