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
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->text('motivation_letter')->nullable();
            $table->text('proposed_rate')->default("0.00");
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->foreignId('mission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('freelance_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};
