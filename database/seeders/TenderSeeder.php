<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tender;
use Illuminate\Support\Str;

class TenderSeeder extends Seeder
{
    public function run(): void
    {
        $tenders = [
            [
                'type' => 'appel_offre',
                'reference' => 'AO N° 16/2026',
                'title_fr' => 'Acquisition de deux voitures citadines hybrides (5 places)',
                'title_ar' => 'اقتناء سيارتين حضريتين هجينتين (5 مقاعد)',
                'title_en' => 'Acquisition of two hybrid city cars (5 seats)',
                'description_fr' => 'La Société des Ciments d\'Oum El Kelil lance un appel d\'offres pour l\'acquisition de deux voitures citadines hybrides de 5 places au profit de la CIOK.',
                'deadline_date' => '2026-09-17',
                'deadline_time' => '13:00',
                'opening_date' => '2026-09-17',
                'opening_time' => '13:30',
                'status' => 'open',
            ],
            [
                'type' => 'appel_offre',
                'reference' => 'AO N° 15/2026',
                'title_fr' => 'Travaux de fumisterie',
                'title_ar' => 'أشغال المداخن',
                'title_en' => 'Chimney works',
                'description_fr' => 'Travaux de fumisterie pour l\'usine de la CIOK.',
                'deadline_date' => '2026-09-17',
                'deadline_time' => '12:00',
                'opening_date' => '2026-09-17',
                'opening_time' => '12:30',
                'status' => 'open',
            ],
            [
                'type' => 'appel_offre',
                'reference' => 'AO N° 14/2026',
                'title_fr' => 'Achat de gypse',
                'title_ar' => 'شراء الجبس',
                'title_en' => 'Purchase of gypsum',
                'description_fr' => 'Achat de gypse pour la production de ciment.',
                'deadline_date' => '2026-09-17',
                'deadline_time' => '11:00',
                'opening_date' => '2026-09-17',
                'opening_time' => '11:30',
                'status' => 'open',
            ],
            [
                'type' => 'consultation_elargie',
                'reference' => 'CE N° 10/2026',
                'title_fr' => 'Achat de sacs d\'emballage pour ciments',
                'title_ar' => 'شراء أكياس التعبئة للأسمنت',
                'title_en' => 'Purchase of cement packaging bags',
                'description_fr' => 'Consultation élargie pour l\'achat de sacs d\'emballage destinés au conditionnement du ciment.',
                'deadline_date' => '2026-08-11',
                'deadline_time' => '10:00',
                'opening_date' => '2026-08-11',
                'opening_time' => '10:30',
                'status' => 'closed',
            ],
            [
                'type' => 'consultation_elargie',
                'reference' => 'CE N° 09/2026',
                'title_fr' => 'Achat de 26 000 ± 20 % tonnes de coke de pétrole',
                'title_ar' => 'شراء 26,000 ± 20% طن من فحم الكوك البترولي',
                'title_en' => 'Purchase of 26,000 ± 20% tons of petroleum coke',
                'description_fr' => 'Consultation élargie pour l\'achat de 26 000 ± 20 % tonnes de coke de pétrole.',
                'deadline_date' => '2026-07-20',
                'deadline_time' => '10:00',
                'opening_date' => '2026-07-20',
                'opening_time' => '10:30',
                'status' => 'awarded',
            ],
            [
                'type' => 'appel_offre',
                'reference' => 'AO N° 13/2026',
                'title_fr' => 'Acquisition de bande en fils d\'acier pour élévateur',
                'title_ar' => 'اقتناء شريط من الأسلاك الفولاذية للمصعد',
                'title_en' => 'Acquisition of steel wire belt for elevator',
                'description_fr' => 'Acquisition de bande en fils d\'acier pour élévateur de l\'atelier de broyage cru et bandes convoyeurs aux divers ateliers.',
                'deadline_date' => '2026-09-17',
                'deadline_time' => '10:00',
                'opening_date' => '2026-09-17',
                'opening_time' => '10:30',
                'status' => 'open',
            ],
        ];

        foreach ($tenders as $tender) {
            $tender['slug'] = Str::slug($tender['reference']) . '-' . uniqid();
            $tender['is_published'] = true;
            $tender['published_at'] = now()->subDays(rand(1, 60));

            Tender::create($tender);
        }
    }
}