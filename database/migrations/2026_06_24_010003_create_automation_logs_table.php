<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('automation_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('automation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('step_id')->constrained('automation_steps')->cascadeOnDelete();
            $table->foreignId('contact_id')->constrained()->cascadeOnDelete();
            $table->timestamp('processed_at')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->text('error')->nullable();
            $table->timestamps();

            $table->unique(['step_id', 'contact_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('automation_logs');
    }
};
