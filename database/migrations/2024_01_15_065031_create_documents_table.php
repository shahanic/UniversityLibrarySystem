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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('document_type_id');
            $table->integer('document_sub_type_id')->nullable();
            $table->string('link', 100)->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->text('abstract')->nullable();
            $table->text('src');
            $table->integer('links_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
