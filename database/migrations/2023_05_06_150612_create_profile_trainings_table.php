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
        Schema::create('profile_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('model');
            $table->string('training_name');
            $table->string('participant_requirement');
            $table->string('instructor_requirement')->nullable();
            $table->string('description');
            $table->string('training_goal');
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
        Schema::dropIfExists('profile_trainings');
    }
};
