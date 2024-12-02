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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('type');
            $table->boolean('black')->default(false);
            $table->boolean('white')->default(false);
            $table->boolean('red')->default(false);
            $table->boolean('green')->default(false);
            $table->boolean('blue')->default(false);
            $table->integer('cmc')->dafault(0);
            $table->text('text');
            $table->text('image');
            $table->text('scryfall_uri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
