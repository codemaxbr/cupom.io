<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOptionalsTable.
 */
class CreateOptionalsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('optionals', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->uuid('uuid');
            $table->text('description')->nullable();
            $table->integer('email_template_id')->nullable();
            $table->boolean('suspend_principal')->default('0');
            $table->decimal('price', 13, 2)->nullable();
            $table->integer('type_term_id')->unsigned();
            $table->integer('payment_cycle_id')->unsigned();
            $table->integer('visibility')->nullable()->default('0');
            $table->text('plans')->nullable();
            $table->timestamps();
            $table->integer('account_id')->unsigned();

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
		Schema::drop('optionals');
	}
}
