<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('lead_id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('note')->nullable();
            $table->string('file');
            $table->string('file_type')->nullable();
            $table->string('module_type')->nullable();
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
        Schema::dropIfExists('lead_files');
    }
}
