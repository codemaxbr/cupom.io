<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateInvoicesTable.
 */
class CreateInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('invoices', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->decimal('total', 13,2);
            $table->decimal('fee', 13,2)->nullable()->default(0);
            $table->decimal('discount', 13,2)->nullable()->default(0);
            $table->integer('type_invoice_id')->unsigned();
            $table->uuid('uuid');
            $table->date('due');
            $table->string('reason')->nullable();
            $table->text('obs')->nullable();
            $table->integer('status')->default('0');
            $table->timestamps();
            $table->integer('account_id')->unsigned();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->foreign('type_invoice_id')
                ->references('id')
                ->on('type_invoices')
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
		Schema::drop('invoices');
	}
}
