<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatchInstallDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patch_install_dates', function (Blueprint $table) {
            $table->id();
            $table->string('server_id')->nullable();
            $table->string('server_name')->nullable();
            $table->date('file_date')->nullable();
            $table->date('patch_installed_date')->nullable();
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
        Schema::dropIfExists('patch_install_dates');
    }
}
