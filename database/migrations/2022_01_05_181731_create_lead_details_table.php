<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('firstname')->nullable();
            $table->string('lastname');
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->string('rating')->nullable();
            $table->string('pnumber')->nullable();
            $table->string('site')->nullable();
            $table->string('leadstatus')->nullable();
            $table->string('leadsource')->nullable();
            $table->integer('converted')->default('0');
            $table->string('designation')->nullable();
            $table->string('assign');
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
        Schema::dropIfExists('lead_details');
    }
}
