<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapsuleServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capsule_servers', function (Blueprint $table) {
            $table->id();
            $table->string('capsule')->nullable();
            $table->string('fully_qualified_domain_name')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('optional_status')->nullable();
            $table->string('os_version')->nullable();
            $table->string('kernel_release')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('hosted_application')->nullable();
            $table->string('support_group')->nullable();
            $table->string('environment')->nullable();
            $table->string('patching_schedule')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('capsule_servers');
    }
}
