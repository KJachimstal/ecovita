<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->nullableMorphs('userable');
            $table->rememberToken();
            $table->string('pesel');
            $table->string('phone_number');
            $table->string('city');
            $table->string('post_code');
            $table->string('street');
            $table->string('street_number');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_pending')->default(false);
            $table->boolean('is_panel_active')->default(false);
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
        Schema::dropIfExists('users');
    }
}
