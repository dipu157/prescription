<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('appointment_no')->unsigned()->unique();
            $table->date('appointment_date');
            $table->string('appointment_type',2);
            $table->string('appointment_newrepeat',1);
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('external_id')->on('hresources')->onDelete('RESTRICT');
            $table->integer('registration_no',false)->nullable()->unsigned();
            $table->string('title',20)->nullable();
            $table->string('first_name',150)->nullable();
            $table->string('middle_name',150)->nullable();
            $table->string('last_name',150)->nullable();
            $table->string('name',240);
            $table->string('father_name',240);
            $table->date('dob')->nullable();
            $table->integer('age',false)->nullable();
            $table->string('gender',1)->nullable();
            $table->string('address',240)->nullable();
            $table->string('mobile',30)->nullable();
            $table->string('email',190)->nullable();
            $table->timestamp('from_time')->nullable();
            $table->timestamp('to_time')->nullable();
            $table->integer('purpose')->default(1);
            $table->integer('prescription_id')->unsigned()->nullable();
            $table->date('visit_date')->nullable();
            $table->integer('serial_no')->unsigned();
            $table->string('problems',240)->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
