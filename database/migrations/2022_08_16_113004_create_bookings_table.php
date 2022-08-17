<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('frame_no')->nullable();
            $table->string('service');
            $table->string('plate_no');
            $table->string('complaint')->nullable();
            $table->string('brand');
            $table->string('type');
            $table->string('color');
            $table->integer('year');
            $table->enum('facility',['datang','jemput']);
            $table->string('transmition');
            $table->date('date');
            $table->time('time');
            $table->integer('estimation');
            $table->enum('status',['tertunda','dikerjakan','selesai']);
            $table->enum('reschedule',['0','1']);
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
        Schema::dropIfExists('bookings');
    }
};
