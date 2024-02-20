<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateServersTable.
 */
class CreateServersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servers', function(Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('monitor')->nullable();
            $table->string('name');
            $table->string('datacenter')->nullable();
            $table->ipAddress('ip');
            $table->integer('limit_accounts')->default('0');
            $table->decimal('cost', 13,2)->nullable();
            $table->integer('provider_id')->unsigned();
            $table->string('ns1')->nullable();
            $table->ipAddress('ns1_ip')->nullable();
            $table->string('ns2')->nullable();
            $table->ipAddress('ns2_ip')->nullable();
            $table->string('ns3')->nullable();
            $table->ipAddress('ns3_ip')->nullable();
            $table->string('ns4')->nullable();
            $table->ipAddress('ns4_ip')->nullable();
            $table->integer('module_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->text('config')->nullable();
            $table->timestamps();
		});

		Schema::table('servers', function (Blueprint $table){
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->foreign('module_id')
                ->references('id')
                ->on('modules');

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servers');
	}
}
