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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_type_id')->nullable();
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->double('quota');
            $table->unsignedBigInteger('gas_station_id')->nullable();
            $table->foreign('gas_station_id')->references('id')->on('gas_stations');
            $table->unsignedBigInteger('detail_vehicle_id')->nullable();
            $table->foreign('detail_vehicle_id')->references('id')->on('detail_vehicles');
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
        Schema::dropIfExists('logs');
    }
};
