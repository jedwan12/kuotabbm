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
            $table->unsignedBigInteger('management_type_id')->nullable();
            $table->foreign('management_type_id')->references('id')->on('management_types');
            $table->double('quota');
            $table->string('note', 255)->nullable();
            $table->unsignedBigInteger('gas_station_id')->nullable();
            $table->foreign('gas_station_id')->references('id')->on('gas_stations');
            $table->unsignedBigInteger('detail_distribution_id')->nullable();
            $table->foreign('detail_distribution_id')->references('id')->on('detail_distributions');
            $table->string('updated_by', 255 )->nullable();
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
