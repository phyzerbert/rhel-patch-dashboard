<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCbdApplicationContactInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cbd_application_contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('internal_name')->nullable();
            $table->string('hostname')->nullable();
            $table->string('company')->nullable();
            $table->text('customer_mail_ids')->nullable();
            $table->text('account_dl')->nullable();
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
        Schema::dropIfExists('cbd_application_contact_infos');
    }
}
