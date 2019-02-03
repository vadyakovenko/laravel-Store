<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_settings', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('import_method');

            $table->integer('provider_id')->unique()->references('id')->on('providers');

            $table->json('separator_product');
            $table->json('separator_variant');

            $table->json('product');
            $table->json('name');
            $table->json('code');
            $table->json('price');
            $table->json('description')->nullable();
            $table->json('quantity')->nullable();
            $table->json('color')->nullable();
            $table->json('size')->nullable();
            $table->json('photo');

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
        Schema::dropIfExists('import_settings');
    }
}
