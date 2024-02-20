<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCustomersTable.
 */
class CreateCustomersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Nome'); //name ou razao social
            $table->uuid('uuid');
            $table->enum('type', ['fisica', 'juridica'])->comment('Tipo Pessoa');
            $table->string('cpf_cnpj',18)->nullable()->comment('CPF / CNPJ');
            $table->string('password')->nullable();
            $table->string('email')->nullable()->comment('E-mail');
            $table->string('email_nfe')->nullable()->comment('E-mail Nfe');
            $table->string('business')->nullable()->comment('Nome Fantasia');
            $table->string('phone',20)->nullable()->comment('Telefone');
            $table->string('mobile',20)->nullable()->comment('Celular');
            $table->string('ins_municipal',20)->nullable()->comment('Inscrição Municipal');
            $table->string('ins_estadual',20)->nullable()->comment('Inscrição Estadual');
            $table->string('skype',150)->nullable()->comment('Skype');
            $table->string('whatsapp',50)->nullable()->comment('WhatsApp');
            $table->string('rg',50)->nullable()->comment('RG');
            $table->date('birthdate')->nullable()->comment('Data de Nascimento');
            $table->enum('genre',['M', 'F', 'O'])->comment('Gênero');
            $table->boolean('status')->default('0');
            $table->text('obs')->nullable()->comment('Observação');
            $table->timestamps();
            $table->integer('account_id')->unsigned();
            $table->integer('vindi_id')->nullable()->unsigned()->comment('Vindi Cliente ID');

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
		Schema::drop('customers');
	}
}
