<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        $table->string('email')->unique();
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('company')->nullable();
        $table->string('phone')->nullable();
        $table->date('birthday')->nullable();
        $table->string('street')->nullable();
        $table->string('address2')->nullable();
        $table->string('city')->nullable();
        $table->string('region')->nullable();
        $table->string('postal')->nullable();
        $table->string('country')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
