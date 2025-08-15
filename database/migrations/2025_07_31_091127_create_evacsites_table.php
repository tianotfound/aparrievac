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
        Schema::create('evacsites', function (Blueprint $table) {
            $table->id();
            $table->string('sitename');
            $table->string('type');
            $table->integer('capacity');
            $table->decimal('lat', 10, 8);
            $table->decimal('lang', 11, 8);
            $table->text('address');
            $table->string('room')->nullable();
            $table->string('powerstatus');
            $table->string('waterstatus');
            $table->string('status');
            $table->string('head');
            $table->string('contact');
            $table->integer('medicine_qty');
            $table->integer('toiletries_qty');
            $table->integer('relief_goods_qty');
            $table->integer('beddings_qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evacsites');
    }
};
