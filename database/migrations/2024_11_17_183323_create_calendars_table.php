<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string("start");
            $table->string("end");
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->string("name");
            $table->string("type");
            $table->string("image");
            $table->boolean("is_complete")->default(false);
            $table->string("description");
            $table->integer("places");
            $table->foreignId("class_id")->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
