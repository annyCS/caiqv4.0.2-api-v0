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

            $table->text('name')->unique();
            $table->mediumText('description')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('lastupdate_at')->nullable();
            $table->string('created_by')->index();
            $table->string('lastupdate_by')->index();

            $table->foreign('created_by')
                ->references('username')
                ->on('users')
                ->onUpdate('cascade');
            
            $table->foreign('lastupdate_by')
                ->references('username')
                ->on('users')
                ->onUpdate('cascade');
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
