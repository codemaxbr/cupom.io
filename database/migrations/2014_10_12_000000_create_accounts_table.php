<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAccountsTable.
 */
class CreateAccountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name_business')->nullable();
            $table->uuid('uuid')->unique();
            $table->binary('logo')->nullable();
            $table->string('domain')->unique();
            $table->string('email_contact')->nullable();
            $table->boolean('status')->default('0');
            $table->integer('reseller_id')->unsigned();
            $table->timestamps();

            $table->foreign('reseller_id')
                ->references('id')
                ->on('resellers')
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
		Schema::drop('accounts');
	}
}
