<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            // PostgreSQL (Render) : ne rien faire
            // La colonne type accepte déjà n'importe quelle valeur string
            // La contrainte sera ajoutée plus tard si nécessaire
        } else {
            // MySQL (Local) : modifier l'enum
            DB::statement("ALTER TABLE tenders MODIFY COLUMN type ENUM('appel_offre', 'consultation', 'consultation_elargie') DEFAULT 'appel_offre'");
        }
    }

    public function down(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            // Rien à faire
        } else {
            DB::statement("ALTER TABLE tenders MODIFY COLUMN type ENUM('appel_offre', 'consultation_elargie') DEFAULT 'appel_offre'");
        }
    }
};