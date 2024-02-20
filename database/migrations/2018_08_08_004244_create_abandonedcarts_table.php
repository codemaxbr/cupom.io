<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateAbandonedCartsTable extends Migration 
{
	public function up()
	{
		Schema::create('abandoned_carts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->nullable()->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->ipAddress('ip');
            $table->string('email')->nullable();
            $table->decimal('total', 13, 2);
            $table->boolean('status')->default(0);
            $table->boolean('status_email')->default(0);
            $table->integer('account_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('abandoned_carts', function($table) {
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::drop('abandoned_carts');
	}
}
