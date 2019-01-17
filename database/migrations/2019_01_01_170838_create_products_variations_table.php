<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_variations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();   
            $table->text('description')->nullable();
            $table->integer('main_photo_id')->references('id')->on('photos')->nullable();     
            $table->integer('product_id')->references('id')->on('products');
            $table->integer('color_id')->references('id')->on('colors')->nullable();
            $table->string('color_value')->nullable();
            $table->decimal('price', 6, 2);
            $table->decimal('parser_price', 6, 2);
            $table->integer('quantity')->nullable();
            $table->text('original_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_variations', function (Blueprint $table) {
            $table->dropIfExists('products_variations');
        });
    }
}
