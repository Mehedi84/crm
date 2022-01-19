<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadAddresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_addres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lead_id')->nullable();
            $table->string('city')->nullable();
            $table->string('code')->nullable();
            $table->string('state')->nullable();
            $table->string('pobox')->nullable();
            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('description')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('leadaddresstype')->nullable();
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
        Schema::dropIfExists('lead_addres');
    }
}
