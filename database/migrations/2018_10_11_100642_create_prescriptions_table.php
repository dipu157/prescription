<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('appointment_id')->unsigned();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('RESTRICT');
            $table->integer('registration_no',false)->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('external_id')->on('hresources')->onDelete('RESTRICT');
            $table->date('record_date');
            $table->string('complains',999)->nullable();
            $table->string('weight',100)->nullable()->default(0);
            $table->string('bp',100)->nullable()->default(0);
            $table->string('sugar',100)->nullable()->default(0);
            $table->string('temperature',10)->nullable();
            $table->string('pulse',10)->nullable();
            $table->string('advice',240)->nullable();
            $table->string('diagnosis',999)->nullable();
            $table->string('stage',240)->nullable();
            $table->string('pgroup',240)->nullable();
            $table->string('o2sat',240)->nullable();
            $table->string('current_medication',240)->nullable();
            $table->string('remarks',240)->nullable();
            $table->string('image',240)->nullable();
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
        Schema::dropIfExists('prescriptions');
    }
}
