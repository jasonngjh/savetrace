<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('patient_id')->constrained('patients');
            $table->foreignId('from_doctor_id')->constrained('doctors');
            $table->foreignId('to_doctor_id')->constrained('doctors');
            $table->date('visited_on')->nullable();
            $table->boolean('viewed')->default(false);
            $table->text('file_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['from_doctor_id']);
            $table->dropForeign(['to_doctor_id']);
        });
        Schema::dropIfExists('referrals');
    }
}
