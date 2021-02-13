<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('practice_place')->constrained('practice_places');
            $table->foreignId('user_id')->nullable()->constrained('users');
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
        Schema::table('nurses', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropForeign(['practice_place']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('nurses');
    }
}
