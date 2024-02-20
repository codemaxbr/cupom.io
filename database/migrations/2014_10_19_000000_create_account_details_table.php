<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAccountDetailsTable.
 */
class CreateAccountDetailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('account_details', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->unsigned();
            $table->string('owner');
            $table->string('email');
            $table->string('cpf_cnpj');
            $table->string('phone');
            $table->enum('type', ['fisica', 'juridica']);
            $table->integer('account_plan_id')->unsigned();
            $table->integer('type_payment_id')->unsigned();
            $table->integer('payment_cycle_id')->unsigned();
            $table->date('expires')->nullable();
            $table->timestamps();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_payment_id')
                ->references('id')
                ->on('type_payments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('payment_cycle_id')
                ->references('id')
                ->on('payment_cycles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('account_plan_id')
                ->references('id')
                ->on('account_plans')
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
		Schema::drop('account_details');
	}
}
