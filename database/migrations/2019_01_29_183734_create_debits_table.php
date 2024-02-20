<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateDebitsTable.
 */
class CreateDebitsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('debits', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('total', 13,2);
            $table->integer('provider_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('n_document')->nullable();
            $table->date('due');
            $table->dateTime('paid')->nullable();
            $table->integer('payment_cycle_id')->unsigned();
            $table->string('description');
            $table->timestamps();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->onDelete('cascade');

            $table->foreign('payment_cycle_id')
                ->references('id')
                ->on('payment_cycles')
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
		Schema::drop('debits');
	}
}
