<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table): void {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('car_id');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations');

            $table->foreign('car_id')
                ->references('id')
                ->on('cars');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
}
