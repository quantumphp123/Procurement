<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddToRedirectToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('to_redirect')->default('customer')->after('name');
        });

        // Update existing roles with redirect paths
        DB::table('roles')->where('name', 'admin')->update(['to_redirect' => 'admin']);
        DB::table('roles')->where('name', 'seller')->update(['to_redirect' => 'seller']);
        DB::table('roles')->where('name', 'customer')->update(['to_redirect' => 'customer']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('to_redirect');
        });
    }
}
