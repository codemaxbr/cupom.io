<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBanksTable.
 */
class CreateBanksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('bank');
            $table->string('owner');
            $table->string('wallet');
            $table->string('type_bank');
            $table->integer('agency');
            $table->integer('account');
            $table->integer('digit');
            $table->integer('account_id')->unsigned();
            $table->timestamps();

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
		Schema::drop('banks');
	}
}
