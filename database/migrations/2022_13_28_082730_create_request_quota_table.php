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
            $table->boolean('is_approval')->nullable();
            $table->unsignedBigInteger('detail_distribution_id')->nullable();
            $table->foreign('detail_distribution_id')->references('id')->on('detail_distributions');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('reason_request', 255)->nullable();
            $table->string('reason_reject', 255)->nullable();
            $table->enum('status', ['active', 'deleted'])->default('active');
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
        Schema::dropIfExists('request_quota');
    }
};
