<?php

namespace Database\Seeders;

use App\Models\TenderDocument;
use Illuminate\Database\Seeder;

class TenderDocumentSeeder extends Seeder
{
    public function run(): void
    {
        TenderDocument::updateOrCreate(
            ['slug' => 'manuel-achat-ciok'],
            [
                'title'       => 'Manuel d\'achat CIOK',
                'description' => 'Manuel de procédures des achats de la Société des Ciments d\'Oum El Kelil.',
                'icon'        => '📘',
                'badge_label' => 'DOCUMENT OFFICIEL',
                'order'       => 1,
                'is_published'=> true,
            ]
        );

        TenderDocument::updateOrCreate(
            ['slug' => 'plan-previsionnel'],
            [
                'title'       => 'Plan prévisionnel des marchés publics',
                'description' => 'Plan prévisionnel des marchés publics de la CIOK.',
                'icon'        => '📅',
                'badge_label' => 'MARCHÉS À VENIR',
                'order'       => 2,
                'is_published'=> true,
            ]
        );
    }
}