<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateStatementsTable.
 */
class CreateStatementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statements', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('customer_id')->unsigned();
            $table->decimal('total', 13, 2)->nullable()->default(0);
            $table->enum('type', ['credito', 'debito']);
            $table->text('obs')->nullable();
            $table->integer('type_payment_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('type_invoice_id')->unsigned();
            $table->timestamps();
		});

        Schema::table('statements', function($table) {
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_invoice_id')
                ->references('id')
                ->on('type_invoices')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_payment_id')
                ->references('id')
                ->on('type_payments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
		Schema::drop('statements');
	}
}
