<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql')->create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('action');
            $table->string('url');
            $table->string('params');
            $table->string('user_agent');
            $table->string('ip_address');
            $table->string('description');
            $table->json('details');
            $table->nullableMorphs('record');
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
        Schema::connection('pgsql')->dropIfExists('logs');
    }
}
