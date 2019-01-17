<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id')->references('id')->on('providers');
            $table->integer('category_id');
            $table->integer('parent_category_id')->nullable();
            $table->string('value');
            $table->integer('store_category_id')->references('id')->on('categories')->nullable();

            $table->unique(['provider_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('providers_categories', function (Blueprint $table) {
            $table->dropIfExists('providers_categories');
        });
    }
}
