<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizesProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes_product_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variation_id')->references('id')->on('products_variations');
            $table->integer('size_id')->references('id')->on('sizes')->nullable();
            $table->string('parser_value')->nullable();
            $table->integer('quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sizes_product_variations', function (Blueprint $table) {
            $table->dropIfExists('sizes_product_variations');
        });
    }
}
