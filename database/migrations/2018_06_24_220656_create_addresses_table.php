<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCustomerAddressesTable.
 */
class CreateAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table) {
            $table->increments('id');
            // Dados de Endereço
            $table->string('zipcode',10)->nullable()->comment('CEP');
            $table->string('address')->nullable()->comment('Endereço');
            $table->string('number',10)->nullable()->comment('Número');
            $table->string('uf', 10)->nullable()->comment('UF');
            $table->string('city',150)->nullable()->comment('Cidade');
            $table->string('district',150)->nullable()->comment('Bairro');
            $table->string('additional',150)->nullable()->comment('Complemento');

            $table->integer('customer_id')->nullable()->unsigned();
            $table->integer('provider_id')->nullable()->unsigned();
            $table->timestamps();
		});

        Schema::table('addresses', function($table) {
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
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
		Schema::drop('addresses');
	}
}
