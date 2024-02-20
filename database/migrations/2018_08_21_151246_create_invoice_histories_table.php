<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateInvoiceHistoriesTable.
 */
class CreateInvoiceHistoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_histories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('invoice_id')->unsigned();
            $table->integer('type_activity_id')->unsigned();
            $table->timestamps();
		});

        Schema::table('invoice_histories', function($table) {
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_activity_id')
                ->references('id')
                ->on('type_activities')
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
		Schema::drop('invoice_histories');
	}
}
