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
        Schema::create('evacuees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evacsites_id')->constrained()->onDelete('cascade');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('contact_number');
            $table->integer('age');
            $table->string('gender');
            $table->string('barangay');
            $table->string('address');
            $table->integer('family_count')->default(1);
            $table->text('medical_condition')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evacuees');
    }
};
