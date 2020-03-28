<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('prescription_id')->unsigned();
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('RESTRICT');
            $table->date('record_date');
            $table->string('food_allergies',240)->nullable();
            $table->boolean('chk_food_allergies')->default(0);
            $table->string('tendency_bleed',240)->nullable();
            $table->boolean('chk_tendency_bleed')->default(0);
            $table->string('heart_disease',240)->nullable();
            $table->boolean('chk_heart_disease')->default(0);
            $table->string('hbp',240)->nullable();
            $table->boolean('chk_hbp')->default(0);
            $table->string('diabetic',240)->nullable();
            $table->boolean('chk_diabetic')->default(0);
            $table->string('surgery',240)->nullable();
            $table->boolean('chk_surgery')->default(0);
            $table->string('accident',240)->nullable();
            $table->boolean('chk_accident')->default(0);
            $table->string('others',240)->nullable();
            $table->boolean('chk_others')->default(0);
            $table->string('fmh',240)->nullable()->comments('Family Medical History');
            $table->boolean('chk_fmh')->default(0);
            $table->string('current_medication',240)->nullable();
            $table->boolean('chk_current_medication')->default(0);
            $table->string('female_pregnancy',240)->nullable();
            $table->boolean('chk_female_pregnancy')->default(0);
            $table->string('breast_feeding',240)->nullable();
            $table->boolean('chk_breast_feeding')->default(0);
            $table->string('health_insurance',240)->nullable();
            $table->boolean('chk_health_insurance')->default(0);
            $table->string('low_income',240)->nullable();
            $table->boolean('chk_low_income')->default(0);
            $table->string('reference',240)->nullable();
            $table->boolean('chk_reference')->default(0);
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
        Schema::dropIfExists('patient_histories');
    }
}
