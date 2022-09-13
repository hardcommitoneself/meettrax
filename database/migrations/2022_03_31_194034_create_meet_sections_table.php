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
        Schema::create('meet_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meet_event_id')->constrained('meet_events')->onDelete('cascade');
            $table->string('name');
            $table->tinyInteger('num');
            $table->tinyInteger('of');
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
        Schema::dropIfExists('meet_sections');
    }
};
