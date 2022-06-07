<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('subscription_status')->nullable();
            $table->string('installable_updates_security')->nullable();
            $table->string('installable_updates_bug_fixes')->nullable();
            $table->string('installable_updates_enhancements')->nullable();
            $table->string('installable_updates_package_count')->nullable();
            $table->string('os')->nullable();
            $table->string('environment')->nullable();
            $table->string('content_view')->nullable();
            $table->timestamp('registered')->nullable();
            $table->timestamp('last_checkin')->nullable();
            $table->integer('site_id')->nullable();
            $table->integer('app_id')->nullable();
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
        Schema::dropIfExists('servers');
    }
}
