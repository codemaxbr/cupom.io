<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProvidersTable.
 */
class CreateProvidersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('fantasia')->nullable();
            $table->uuid('uuid');
            $table->enum('type', ['fisica', 'juridica']);
            $table->string('cpf_cnpj', 18);
            $table->string('email');
            $table->string('phone');
            $table->string('mobile')->nullable();
            $table->string('insc_municipal')->nullable();
            $table->string('insc_estadual')->nullable();
            $table->date('birthdate')->nullable();
            $table->boolean('status')->default('0');
            $table->text('obs')->nullable()->comment('Observação');
            $table->integer('account_id')->unsigned();
            $table->timestamps();

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
		Schema::drop('providers');
	}
}
