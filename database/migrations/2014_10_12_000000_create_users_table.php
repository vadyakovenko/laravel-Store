<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Entity\User\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status', 16);
            $table->string('role', 16);
            $table->string('verify_token')->nullable()->unique();
            $table->rememberToken();
            $table->timestamps();

        });
        User::createAdmin('Admin', env('ADMIN_EMAIL', 'admin@admin.com'), env('ADMIN_PASSWORD', 'secret'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
