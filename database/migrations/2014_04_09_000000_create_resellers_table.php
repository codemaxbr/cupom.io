<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateResellersTable.
 */
class CreateResellersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resellers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('Nome / Razão Social');
            $table->string('email')->unique()->comment('E-mail');
            $table->enum('type', ['fisica', 'juridica'])->comment('Tipo Pessoa');
            $table->string('cpf_cnpj',18)->nullable()->comment('CPF / CNPJ');
            $table->string('password')->nullable();
            $table->string('email_nfe')->nullable()->comment('E-mail Nfe');
            $table->string('phone',20)->nullable()->comment('Telefone');
            $table->string('mobile',20)->nullable()->comment('Celular');
            $table->string('ins_municipal',20)->nullable()->comment('Inscrição Municipal');
            $table->string('ins_estadual',20)->nullable()->comment('Inscrição Estadual');
            $table->string('skype',150)->nullable()->comment('Skype');
            $table->string('whatsapp',50)->nullable()->comment('WhatsApp');
            $table->date('birthdate')->nullable()->comment('Data de Nascimento');
            $table->boolean('status')->default('0');
            $table->text('obs')->nullable()->comment('Observação');
            $table->boolean('confirmed')->default('0');
            $table->string('token')->nullable();
            $table->rememberToken();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resellers');
	}
}
