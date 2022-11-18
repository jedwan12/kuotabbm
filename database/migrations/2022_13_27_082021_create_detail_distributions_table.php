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
        Schema::create('detail_distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_vehicle_id')->nullable();
            $table->foreign('detail_vehicle_id')->references('id')->on('detail_vehicles');
            $table->unsignedBigInteger('distribution_id')->nullable();
            $table->foreign('distribution_id')->references('id')->on('distributions');
            $table->enum('status', ['active', 'deleted'])->default('active');
            $table->double('quota');
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
        Schema::dropIfExists('detail_distributions');
    }
};
