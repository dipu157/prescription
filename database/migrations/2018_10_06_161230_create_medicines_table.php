<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('generic_id')->unsigned(); //section
            $table->foreign('generic_id')->references('id')->on('generics')->onDelete('RESTRICT');
            $table->integer('strength_id')->unsigned(); //section
            $table->foreign('strength_id')->references('id')->on('strengths')->onDelete('RESTRICT');
            $table->integer('medicine_type_id')->unsigned(); //section
            $table->foreign('medicine_type_id')->references('id')->on('medicine_types')->onDelete('RESTRICT');
            $table->integer('manufacturer_id')->unsigned(); //section
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->onDelete('RESTRICT');
            $table->integer('doctor_id',false)->unsigned()->nullable(); //section
            $table->boolean('is_group')->default(0);
            $table->integer('item_code',false)->unsigned()->nullable();
            $table->string('name',254)->unique();
            $table->string('description',254)->nullable();
            $table->boolean('status')->default(1);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
