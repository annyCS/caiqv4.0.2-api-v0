<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnOrgQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionn_org_question', function (Blueprint $table) {
            $table->unsignedBigInteger('questionnaire_id');
            $table->unsignedBigInteger('question_id');
            $table->primary(['questionnaire_id', 'question_id']);
            $table->unsignedBigInteger('organization_id')->index();
            
            $table->enum('csp_caiq_answer', ['Yes', 'No', 'NA'])->default('NA')->nullable();
            $table->enum('ssrm_control_ownership', ['CSP-owned', 'CSC-owned', '3rd-party outsourced', 'Shared CSP and CSC', 'Shared CSP and 3rd-party'])->nullable();
            $table->longText('csp_implementation_description')->nullable();
            $table->longText('csc_responsibilities')->nullable();

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
            
            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
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
        Schema::dropIfExists('questionn_org_question');
    }
}
