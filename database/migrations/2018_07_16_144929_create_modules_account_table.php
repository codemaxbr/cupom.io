<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules_account', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('module_id')->unsigned();
            $table->integer('server_id')->nullable()->unsigned();
            $table->integer('account_id')->unsigned();
            $table->text('config')->nullable();
            $table->timestamps();

            $table->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->onDelete('cascade');

            $table->foreign('server_id')
                ->references('id')
                ->on('servers')
                ->onDelete('cascade');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules_account');
    }
}
