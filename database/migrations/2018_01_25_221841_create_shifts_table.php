<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_title');
            $table->enum('role', array('doctor', 'nurse'))->default(NULL);
            $table->unsignedInteger('practice_id');
            $table->foreign('practice_id')->references('id')->on('practice')->onDelete('cascade');
            $table->text('description');
            $table->date('start_time');
            $table->date('end_time');
            $table->integer('price');
            $table->boolean('is_permanent')->default(false);
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
        Shema::table('shifts', function(Blueprint $table) {
            $table->dropForeign('shifts_practice_id_foreign');
        });
        Schema::dropIfExists('shifts');
    }
}
