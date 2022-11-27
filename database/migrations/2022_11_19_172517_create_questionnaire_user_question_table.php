<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireUserQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_user_question', function (Blueprint $table) {
            $table->unsignedBigInteger('questionnaire_id');
            $table->unsignedBigInteger('question_id');
            $table->primary(['questionnaire_id', 'question_id']);
            $table->unsignedBigInteger('user_id')->index();

            $table->string('csp_caiq_answer')->nullable();
            $table->string('ssrm_control_ownership')->nullable();
            $table->text('csp_implementation_description')->nullable();
            $table->text('csc_responsibilities')->nullable();

            $table->foreign('questionnaire_id')
				->references('id')
				->on('questionnaires')
                ->onUpdate('cascade')
                ->onDelete('cascade');

			$table->foreign('question_id')
				->references('id')
				->on('questions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('questionnaire_user_question');
    }
}
