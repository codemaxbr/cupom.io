<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePriceDomainsTable.
 */
class CreatePriceDomainsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('price_domains', function(Blueprint $table) {
            $table->increments('id');
            $table->string('extension');
            $table->integer('module_id')->unsigned()->default(1);
            $table->decimal('cost', 13,2)->nullable();
            $table->decimal('price_register', 13,2)->nullable();
            $table->decimal('price_renew', 13,2)->nullable();
            $table->decimal('price_transfer', 13,2)->nullable();
            $table->timestamps();
            $table->integer('account_id')->unsigned();

            $table->foreign('module_id')
                ->references('id')
                ->on('modules');

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
		Schema::drop('price_domains');
	}
}
