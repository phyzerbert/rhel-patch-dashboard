<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteCodeSubnetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_code_subnets', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->nullable();
            $table->string('site')->nullable();
            $table->string('site_code')->nullable();
            $table->string('business_unit_site_id')->nullable();
            $table->string('domain')->nullable();
            $table->string('new_code')->nullable();
            $table->string('sub_net')->nullable();
            $table->string('vlan_tag')->nullable();
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
        Schema::dropIfExists('site_code_subnets');
    }
}
