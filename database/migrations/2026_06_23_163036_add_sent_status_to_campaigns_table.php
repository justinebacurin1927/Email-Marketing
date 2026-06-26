<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE campaigns DROP CONSTRAINT IF EXISTS campaigns_status_check");
        DB::statement("ALTER TABLE campaigns ALTER COLUMN status TYPE varchar(255) USING status::varchar(255)");
        DB::statement("ALTER TABLE campaigns ADD CONSTRAINT campaigns_status_check CHECK (status IN ('draft', 'scheduled', 'sent'))");
        DB::statement("ALTER TABLE campaigns ALTER COLUMN status SET DEFAULT 'draft'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE campaigns DROP CONSTRAINT IF EXISTS campaigns_status_check");
        DB::statement("ALTER TABLE campaigns ALTER COLUMN status TYPE varchar(255) USING status::varchar(255)");
        DB::statement("ALTER TABLE campaigns ADD CONSTRAINT campaigns_status_check CHECK (status IN ('draft', 'scheduled'))");
        DB::statement("ALTER TABLE campaigns ALTER COLUMN status SET DEFAULT 'draft'");
    }
};
