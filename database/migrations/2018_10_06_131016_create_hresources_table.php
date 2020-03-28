<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHresourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hresources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('RESTRICT');
            $table->integer('login_id')->unsigned();
            $table->foreign('login_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('RESTRICT');
            $table->integer('role_id')->unsigned()->comment('Doctor, Assistant, Attendant');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('RESTRICT');
            $table->integer('external_id',false)->unsigned()->unique();
            $table->string('title',20)->nullable();
            $table->string('first_name',150)->nullable();
            $table->string('middle_name',150)->nullable();
            $table->string('last_name',150)->nullable();
            $table->string('name',150);
            $table->string('email',190)->nullable();
            $table->string('pr_address',240);
            $table->string('pm_address',240)->nullable();
            $table->string('m_address',240)->nullable(); //Mailing Address
            $table->string('phone',150)->nullable();
            $table->string('mobile',150)->nullable();
            $table->string('biography',150)->nullable();
            $table->date('dob')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('image',240)->nullable();
            $table->string('signature',240)->nullable();
            $table->char('gender',1)->comments('M=> Male F=>Female');
            $table->char('blood_group',30)->nullable();
            $table->string('education',240)->nullable();
            $table->string('speciality',240)->nullable();
            $table->string('card_no',20)->nullable();
            $table->date('card_issue_date')->nullable();
            $table->string('national_id',20)->nullable();
            $table->boolean('is_printed')->default(0);
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
        Schema::dropIfExists('hresources');
    }
}
