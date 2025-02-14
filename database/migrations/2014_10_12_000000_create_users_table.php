<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->binary('photo')->nullable();
            $table->boolean('confirmed')->default('0');
            $table->boolean('is_admin')->default('0');
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('account_id')->unsigned();
        });

        Schema::table('users', function($table) {
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
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
