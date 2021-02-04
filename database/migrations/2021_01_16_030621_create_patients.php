<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->string('name');
            $table->date('date_of_birth');
            $table->string('contact_number');
            $table->string('name_of_emergency_contact')->nullable();
            $table->string('contact_number_of_emergency_contact')->nullable();;
            $table->string('address');
            $table->text('profile_photo_path')->nullable();
            $table->text('allergies')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('patients');
    }
}
