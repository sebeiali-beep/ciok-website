<?php

namespace Database\Seeders;

use App\Models\Tender;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenderSeeder extends Seeder
{
    public function run(): void
    {
        $tenders = [
            [
                'reference'      => 'AO N° 16/2026',
                'type'           => 'appel_offre',
                'title_fr'       => 'Acquisition deux voitures citadines hybrides (5 places) au profit de la CIOK',
                'description_fr' => 'La CIOK lance un appel d\'offres pour l\'acquisition de deux voitures citadines hybrides de 5 places.',
                'deadline_date'  => '2026-09-17',
                'deadline_time'  => '13:00:00',
                'opening_date'   => '2026-09-17',
                'opening_time'   => '13:30:00',
                'status'         => 'open',
                'is_published'   => true,
            ],
            [
                'reference'      => 'CE N° 11/2026',
                'type'           => 'consultation_elargie',
                'title_fr'       => 'Mission d\'assistance comptable - Arrêt des états financiers exercices 2025-2026-2027',
                'description_fr' => 'Consultation élargie pour la mission d\'assistance comptable pour l\'arrêt des états financiers.',
                'deadline_date'  => '2026-10-16',
                'deadline_time'  => '10:00:00',
                'opening_date'   => '2026-10-16',
                'opening_time'   => '10:30:00',
                'status'         => 'open',
                'is_published'   => true,
            ],
            [
                'reference'      => 'AO N° 17/2026',
                'type'           => 'appel_offre',
                'title_fr'       => 'Choix d\'un bureau d\'experts comptables afin de procéder à l\'inventaire physique des biens immobiliers',
                'description_fr' => 'Appel d\'offres pour le choix d\'un bureau d\'experts comptables.',
                'deadline_date'  => '2026-10-20',
                'deadline_time'  => '10:00:00',
                'opening_date'   => '2026-10-20',
                'opening_time'   => '10:30:00',
                'status'         => 'open',
                'is_published'   => true,
            ],
        ];

        foreach ($tenders as $data) {
            $data['slug'] = Str::slug($data['reference'] . '-' . Str::limit($data['title_fr'], 50));
            Tender::updateOrCreate(['reference' => $data['reference']], $data);
        }
    }
}