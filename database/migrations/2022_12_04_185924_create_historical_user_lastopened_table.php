<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricalUserLastopenedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historical_user_lastopened', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');                          // usuario que abrió al menos una vez un cuestionario
            $table->unsignedBigInteger('questionnaire_id')->nullable();     // último cuestionario abierto según el usuario
            $table->timestamp('last_opened_at')->nullable();                // última vez que abrió el usuario el cuestionario

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('questionnaire_id')
                ->references('id')
                ->on('questionnaires')
                ->onUpdate('cascade')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historical_user_lastopened');
    }
}
