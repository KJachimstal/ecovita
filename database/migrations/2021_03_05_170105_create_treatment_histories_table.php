<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment_histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('visit_date');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('doctor_speciality_id')->constrained('doctor_speciality')->onDelete('cascade');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatment_histories');
    }
}
