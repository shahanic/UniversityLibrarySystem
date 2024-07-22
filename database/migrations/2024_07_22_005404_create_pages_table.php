<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    

public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->integer('last_editor_id');
            $table->string('name', 255);
            $table->string('code', 255);
            $table->integer('published');
            $table->integer('nav_id');
            $table->integer('subnav_id');
            $table->timestamps();
        });
    }
}