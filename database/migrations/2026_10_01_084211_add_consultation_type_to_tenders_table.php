<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modifier l'enum pour ajouter 'consultation'
        DB::statement("ALTER TABLE tenders MODIFY COLUMN type ENUM('appel_offre', 'consultation', 'consultation_elargie') DEFAULT 'appel_offre'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tenders MODIFY COLUMN type ENUM('appel_offre', 'consultation_elargie') DEFAULT 'appel_offre'");
    }
};