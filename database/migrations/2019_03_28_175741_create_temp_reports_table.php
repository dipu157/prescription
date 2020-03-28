<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dt_col1')->nullable();
            $table->string('v_col1',250)->nullable();
            $table->string('v_col2',250)->nullable();
            $table->string('v_col3',250)->nullable();
            $table->string('v_col4',250)->nullable();
            $table->string('v_col5',250)->nullable();
            $table->string('v_col6',250)->nullable();
            $table->string('v_col7',250)->nullable();
            $table->string('v_col8',250)->nullable();
            $table->string('v_col9',250)->nullable();
            $table->string('v_col10',250)->nullable();
            $table->unsignedInteger('n_co1')->default(0);
            $table->unsignedInteger('n_co2')->default(0);
            $table->decimal('n_co3',15,2)->default(0.00);
            $table->decimal('n_co4',15,2)->default(0.00);
            $table->decimal('n_co5',15,2)->default(0.00);
            $table->decimal('n_co6',15,2)->default(0.00);
            $table->decimal('n_co7',15,2)->default(0.00);
            $table->decimal('n_co8',15,2)->default(0.00);
            $table->decimal('n_co9',15,2)->default(0.00);
            $table->char('char1',1)->nullable();
            $table->char('char2',1)->nullable();

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
        Schema::dropIfExists('temp_reports');
    }
}
