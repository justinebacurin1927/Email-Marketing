<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['regular', 'automation'])->default('regular');
            $table->enum('status', ['draft', 'scheduled'])->default('draft');
            $table->date('send_date')->nullable();
            $table->foreignId('template_id')->constrained('message_templates');
            $table->foreignId('contact_id')->constrained('contacts');
            $table->timestamps();
        });
}

public function down(): void
{
    Schema::dropIfExists('campaigns');

}

};
