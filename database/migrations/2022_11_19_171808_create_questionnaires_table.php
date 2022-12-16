<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');

            $table->text('name')->nullable();
            $table->mediumText('description')->nullable();
            $table->timestamp('created_at');
            $table->string('created_by')->index()->nullable();
            $table->timestamp('lastupdate_at')->nullable();
            $table->string('lastupdate_by')->index()->nullable();
            $table->enum('status', ['completed', 'in_progress', 'non-status'])->default('non-status');

            $table->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('created_by')
                ->references('email')
                ->on('users')
                ->onUpdate('cascade')
                ->nullOnDelete();
            
            $table->foreign('lastupdate_by')
                ->references('email')
                ->on('users')
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
        Schema::dropIfExists('questionnaires');
    }
}
