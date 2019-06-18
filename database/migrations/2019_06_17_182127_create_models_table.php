<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table): void {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('company_id');

            $table->string('value');
            $table->string('title');

            $table->foreign('company_id')
                ->references('id')
                ->on('companies');

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
        Schema::dropIfExists('models');
    }
}
