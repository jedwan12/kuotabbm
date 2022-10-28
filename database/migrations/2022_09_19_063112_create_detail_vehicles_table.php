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
        Schema::create('detail_vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('car_name', 255);
            $table->unsignedBigInteger('vehicle_type_id')->nullable();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types');
            $table->string('plat_number', 20)->unique();
            $table->unsignedBigInteger('business_unit_id')->nullable();
            $table->foreign('business_unit_id')->references('id')->on('business_units');
            $table->unsignedBigInteger('petrol_id')->nullable();
            $table->foreign('petrol_id')->references('id')->on('petrols');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->double('quota');
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
        Schema::dropIfExists('detail_vehicles');
    }
};
