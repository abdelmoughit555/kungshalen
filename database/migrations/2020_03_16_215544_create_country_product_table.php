<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_product', function (Blueprint $table) {
            $table->bigInteger('country_id')->unsigned()->index();
            $table->bigInteger('product_id')->unsigned()->index();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_product');
    }
}
