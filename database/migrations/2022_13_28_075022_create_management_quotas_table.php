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
        Schema::create('management_quotas', function (Blueprint $table) {
            $table->id();
            $table->double('quota');
            $table->unsignedBigInteger('detail_distribution_id')->nullable();
            $table->foreign('detail_distribution_id')->references('id')->on('detail_distributions');
            $table->string('note', 255)->nullable();
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
        Schema::dropIfExists('management_quotas');
    }
};
