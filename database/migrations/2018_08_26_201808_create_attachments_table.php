<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateAttachmentsTable.
 */
class CreateAttachmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->uuid('uuid');
            $table->integer('account_id')->unsigned();
            $table->morphs('attachmentable');
            $table->string('file_url');
            $table->timestamps();
		});

        Schema::table('attachments', function($table) {
            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
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
		Schema::drop('attachments');
	}
}
