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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_distribution_id')->nullable();
            $table->foreign('detail_distribution_id')->references('id')->on('detail_distributions');
            $table->unsignedBigInteger('gas_station_id')->nullable();
            $table->foreign('gas_station_id')->references('id')->on('gas_stations');
            $table->unsignedBigInteger('petrol_id')->nullable();
            $table->foreign('petrol_id')->references('id')->on('petrols');
            $table->enum('status', ['waiting', 'rejected', 'accept'])->default('waiting');
            $table->double('quota');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('transactions');
    }
};
