<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();

            // Type
            $table->enum('type', ['appel_offre', 'consultation_elargie'])->default('appel_offre');

            // Numéro (ex: AO N° 16/2026)
            $table->string('reference');

            // Objet (traduit)
            $table->string('title_fr');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();

            $table->string('slug')->unique();

            // Description longue
            $table->text('description_fr')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();

            // Dates
            $table->date('deadline_date')->nullable();
            $table->time('deadline_time')->nullable();
            $table->date('opening_date')->nullable();
            $table->time('opening_time')->nullable();

            // Documents (chemin vers PDF)
            $table->string('notice_pdf')->nullable();  // Avis
            $table->string('result_pdf')->nullable();  // Résultats

            // Statut
            $table->enum('status', ['open', 'closed', 'awarded'])->default('open');

            // Publication
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};