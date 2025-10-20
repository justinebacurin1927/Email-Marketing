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
        Schema::table('message_templates', function (Blueprint $table) {
            if (!Schema::hasColumn('message_templates', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('message_templates', 'body')) {
                $table->text('body');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('message_templates', function (Blueprint $table) {
            if (Schema::hasColumn('message_templates', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('message_templates', 'body')) {
                $table->dropColumn('body');
            }
        });
    }
};
