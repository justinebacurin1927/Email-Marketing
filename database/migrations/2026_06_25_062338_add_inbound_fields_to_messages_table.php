<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->string('sender_name')->nullable()->after('source_id');
            $table->string('sender_email')->nullable()->after('sender_name');
            $table->string('subject')->nullable()->after('sender_email');
            $table->foreignId('contact_id')->nullable()->constrained()->nullOnDelete()->after('subject');
            $table->boolean('is_read')->default(false)->after('contact_id');
            $table->boolean('is_trashed')->default(false)->after('is_read');
            $table->string('source_type')->default('email_marketing')->after('is_trashed');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
            $table->dropColumn(['sender_name', 'sender_email', 'subject', 'contact_id', 'is_read', 'is_trashed', 'source_type']);
        });
    }
};
