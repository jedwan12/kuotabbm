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
        Schema::create('detail_users', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30);
            $table->string('name', 255);
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')->references('id')->on('positions');
            $table->unsignedBigInteger('business_unit_id')->nullable();
            $table->foreign('business_unit_id')->references('id')->on('business_units');
            $table->string('phone_number', 20);
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
        Schema::dropIfExists('detail_users');
    }
};
