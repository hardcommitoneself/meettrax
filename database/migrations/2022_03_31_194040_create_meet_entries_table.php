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
        Schema::create('meet_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meet_section_id')->constrained('meet_sections')->onDelete('cascade');
            $table->tinyInteger('num');
            $table->string('name');
            $table->string('grade')->nullable();
            $table->string('school')->nullable();
            $table->string('seed')->nullable();
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
        Schema::dropIfExists('meet_entries');
    }
};
