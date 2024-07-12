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
        Schema::create('generics', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('menu_title', 191)->nullable();
            $table->string('slug', 255);
            $table->text('abstract')->nullable();;
            $table->text('content')->nullable();;
            $table->integer('gallery_id')->nullable();
            $table->integer('navigation_id');
            $table->integer('sub_menu_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generics');
    }
};
