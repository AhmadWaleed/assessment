<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table): void {
            $table->bigIncrements('id');

            $table->unsignedInteger('company_id');
            $table->unsignedInteger('model_id');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies');

            $table->foreign('model_id')
                ->references('id')
                ->on('models');

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
        Schema::dropIfExists('cars');
    }
}
