<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('meet_event_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meet_event_id')->constrained('meet_events')->onDelete('cascade');
            $table->json('body');
            $table->boolean('approved')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meet_event_updates');
    }
};
