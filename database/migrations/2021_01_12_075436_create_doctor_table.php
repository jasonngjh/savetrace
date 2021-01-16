<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('registration_number')->unique();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('fax')->nullable();;
            $table->boolean('internal');
            $table->string('specialty');
            $table->text('profile_photo_path')->nullable();
            $table->text('information')->nullable();
            $table->foreignId('practice_place')->constrained('practiceplaces');
            $table->foreignId('user_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['practice_place']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('doctors');
    }
}
