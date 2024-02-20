<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAccountPlansTable.
 */
class CreateAccountPlansTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_plans', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 13, 2);
            $table->boolean('status')->default(1);
            $table->integer('payment_cycle_id')->unsigned();
            $table->integer('reseller_id')->unsigned();
            $table->timestamps();

            $table->foreign('payment_cycle_id')
                ->references('id')
                ->on('payment_cycles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('reseller_id')
                ->references('id')
                ->on('resellers')
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
		Schema::drop('account_plans');
	}
}
