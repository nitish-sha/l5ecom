<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
           $table->boolean('featured')->default(0)->after('options');
           $table->unsignedInteger('created_by')->after('featured')->default(0);
           $table->boolean('status')->default(0)->after('created_by');


       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('featured');
            $table->dropColumn('created_by');
            $table->dropColumn('status');
        });
    }
}
