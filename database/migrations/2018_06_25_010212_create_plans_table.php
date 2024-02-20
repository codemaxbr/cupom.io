<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePlansTable.
 */
class CreatePlansTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plans', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->uuid('uuid');
            $table->boolean('status')->default('1');
            $table->integer('type_plan_id')->unsigned();
            $table->text('description')->nullable();
            $table->integer('email_template_id')->nullable();
            $table->boolean('domain')->default('0');
            $table->decimal('price', 13, 2)->nullable();
            $table->integer('type_term_id')->unsigned();
            $table->integer('trial')->nullable()->default(0);
            $table->decimal('price_installment', 13, 2)->nullable(); // Preço total parcelado
            $table->integer('installments')->nullable(); // Qtd de parcelas
            $table->integer('payment_cycle_id')->unsigned();
            $table->integer('visibility')->nullable()->default('0');
            $table->integer('module_id')->nullable();
            $table->integer('server_id')->nullable();
            $table->text('config')->nullable();
            $table->timestamps();
            $table->integer('account_id')->unsigned();

            $table->foreign('type_plan_id')
                ->references('id')
                ->on('type_plans')
                ->onDelete('cascade');

            $table->foreign('payment_cycle_id')
                ->references('id')
                ->on('payment_cycles')
                ->onDelete('cascade');

            $table->foreign('type_term_id')
                ->references('id')
                ->on('type_terms')
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
		Schema::dropIfExists('plans');
	}
}
