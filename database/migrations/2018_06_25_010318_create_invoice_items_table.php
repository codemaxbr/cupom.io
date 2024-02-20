<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateInvoiceItemsTable.
 */
class CreateInvoiceItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('type_plan_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->string('domain')->nullable();
            $table->string('description');
            $table->decimal('price', 13,2);
            $table->decimal('discount', 13,2)->nullable();
            $table->integer('qty')->nullable();
            $table->date('data')->nullable();
            $table->date('data_end')->nullable();
            $table->timestamps();
		});

        Schema::table('invoice_items', function($table) {
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('cascade');

            $table->foreign('type_plan_id')
                ->references('id')
                ->on('type_plans');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
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
		Schema::drop('invoice_items');
	}
}
