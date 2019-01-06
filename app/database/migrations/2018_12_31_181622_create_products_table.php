<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('code');
            $table->integer('provider_id')->reference('id')->on('providers');
            $table->integer('category_id')->reference('id')->on('categories')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->decimal('rating', 3, 2)->nullable();
            $table->json('seo_json')->nullable();
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropIfExists('products');
        });
    }
}
