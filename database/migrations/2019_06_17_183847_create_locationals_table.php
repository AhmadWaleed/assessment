<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('locationals', function (Blueprint $table): void {
            $table->bigIncrements('id');

            $table->unsignedInteger('location_id');

            $table->morphs('locational');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations');

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
        Schema::dropIfExists('locationals');
    }
}
