<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
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
            $table->unsignedBigInteger('event_center_id');
            $table->string('name');
            $table->bigInteger('phone');
            $table->string('email');
            $table->integer('guests');
            $table->date('event_date');
            $table->string('scheduled_time');
            $table->string('memo')->nullable();
            $table->timestamps();
            $table->foreign('event_center_id')->references('id')->on('event_centers');
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
}
