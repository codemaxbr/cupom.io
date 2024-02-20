<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateInvoiceAccountItemsTable.
 */
class CreateInvoiceAccountItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_account_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_account_id')->unsigned();
            $table->integer('account_plan_id')->unsigned();
            $table->string('domain')->nullable();
            $table->string('description');
            $table->decimal('price', 13,2);
            $table->decimal('discount', 13,2)->nullable();
            $table->integer('qty')->nullable();
            $table->date('data')->nullable();
            $table->date('data_end')->nullable();
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
		Schema::drop('invoice_account_items');
	}
}
