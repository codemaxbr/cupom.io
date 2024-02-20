<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSubscriptionsTable.
 */
class CreateSubscriptionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriptions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('plan_id')->unsigned();
            $table->integer('optional_id')->nullable()->unsigned();
            $table->date('due');
            $table->decimal('total', 13, 2)->nullable()->default(0);
            $table->dateTime('activated_at');
            $table->boolean('trial')->nullable()->default(0);
            $table->boolean('recurrence')->nullable()->default(0);
            $table->integer('status')->nullable()->default(0);
            $table->string('domain')->nullable();
            $table->integer('server_id')->nullable()->default(0);
            $table->string('login_user')->nullable();
            $table->string('login_password')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('cancelled')->nullable()->default(0);
            $table->integer('type_payment_id')->nullable()->unsigned()->default(0);
            $table->timestamps();
            $table->integer('account_id')->unsigned();
		});

        Schema::table('subscriptions', function($table) {
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('plan_id')
                ->references('id')
                ->on('plans')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('optional_id')
                ->references('id')
                ->on('optionals')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('type_payment_id')
                ->references('id')
                ->on('type_payments')
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
		Schema::drop('subscriptions');
	}
}
