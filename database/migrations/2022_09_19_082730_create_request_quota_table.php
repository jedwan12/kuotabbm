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
        Schema::create('request_quota', function (Blueprint $table) {
            $table->id();
            $table->double('total_request');
            $table->boolean('approval1')->nullable();
            $table->boolean('approval2')->nullable();
            $table->unsignedBigInteger('detail_vehicle_id')->nullable();
            $table->foreign('detail_vehicle_id')->references('id')->on('detail_vehicles');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status', ['active', 'deleted'])->default('active');
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
        Schema::dropIfExists('request_quota');
    }
};
