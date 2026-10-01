<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            // PostgreSQL (Render)
            DB::statement("ALTER TABLE tenders DROP CONSTRAINT IF EXISTS tenders_type_check");
            DB::statement("ALTER TABLE tenders ADD CONSTRAINT tenders_type_check CHECK (type IN ('appel_offre', 'consultation', 'consultation_elargie'))");
        } else {
            // MySQL (Local)
            DB::statement("ALTER TABLE tenders MODIFY COLUMN type ENUM('appel_offre', 'consultation', 'consultation_elargie') DEFAULT 'appel_offre'");
        }
    }

    public function down(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            DB::statement("ALTER TABLE tenders DROP CONSTRAINT IF EXISTS tenders_type_check");
            DB::statement("ALTER TABLE tenders ADD CONSTRAINT tenders_type_check CHECK (type IN ('appel_offre', 'consultation_elargie'))");
        } else {
            DB::statement("ALTER TABLE tenders MODIFY COLUMN type ENUM('appel_offre', 'consultation_elargie') DEFAULT 'appel_offre'");
        }
    }
};