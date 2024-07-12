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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50);
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('abstract')->nullable();
            $table->text('content');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->tinyInteger('status')->comment('1=published; 0=draft');
            $table->integer('gallery_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
