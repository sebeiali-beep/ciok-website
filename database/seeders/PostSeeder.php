<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title_fr' => "Convocation à l'Assemblée Générale Ordinaire et l'Assemblée Générale Extraordinaire",
                'excerpt_fr' => 'Convocation des actionnaires de la société Les Ciments d\'Oum El Kélil (CI.O.K) aux réunions de l\'Assemblée Générale...',
                'content_fr' => "Convocation des actionnaires de la société Les Ciments d'Oum El Kélil (CI.O.K) aux réunions de l'Assemblée Générale Ordinaire et de l'Assemblée Générale Extraordinaire, prévues le 21 octobre 2026 à Tunis, afin de délibérer sur les différents points inscrits à l'ordre du jour, notamment l'approbation des états financiers, l'affectation des résultats, la nomination et le renouvellement des administrateurs, ainsi que la poursuite de l'activité de la société.",
                'image' => 'actualites/convocation.png',
                'pdf' => 'actualites/convocation.pdf',
                'published_at' => '2026-09-28',
            ],
            [
                'title_fr' => "Les Ciments d'Oum El Kélil s'engagent pour l'élimination des déchets contenant des PCB",
                'excerpt_fr' => 'Dans le cadre de sa politique environnementale et de son engagement en faveur du développement durable...',
                'content_fr' => "Dans le cadre de sa politique environnementale et de son engagement en faveur du développement durable, la CIOK participe au Programme national d'élimination des déchets contenant des PCB. Le projet, piloté par le Ministère de l'Environnement avec l'appui du bureau d'études Green Way, vise à assurer l'élimination sécurisée et conforme des déchets dangereux présents sur le site, dans le respect des exigences réglementaires, des normes de sécurité et des bonnes pratiques environnementales.",
                'image' => 'actualites/pcb.png',
                'pdf' => 'actualites/PCB ciok.jpg',
                'published_at' => '2026-08-01',
            ],
            [
                'title_fr' => 'Résultats du concours',
                'excerpt_fr' => 'قائمة المقبولين نهائيا في خطة عون تنظيف',
                'content_fr' => "E-D قائمة المقبولين نهائيا في خطة عون تنظيف",
                'image' => 'actualites/resultat-concours.jpg',
                'pdf' => 'actualites/E-D Resultat final.jpg',
                'published_at' => '2026-05-25',
            ],
            [
                'title_fr' => 'Résultats du concours',
                'excerpt_fr' => 'قائمة المقبولين أوليًا بعد النظر في الاعتراضات',
                'content_fr' => "<p dir='rtl' style='text-align: justify; line-height: 2;'>ليكن في علم كافة المترشحين للخطط التالية: <span dir='ltr'>MA-MB-ME-MI-MH-MN</span> أنه يمكنهم الاطلاع على القائمة النهائية للمقبولين أوليًا بعد النظر في الاعتراضات عبر الموقع الإلكتروني <span dir='ltr'>www.ciok.tn</span>.</p>",
                'image' => 'actualites/resultat-concours.jpg',
                'pdf' => 'actualites/Résultat concours section M 5.pdf',
                'published_at' => '2026-05-12',
            ],
            [
                'title_fr' => 'Résultats du concours',
                'excerpt_fr' => 'إعلان موجّه إلى المترشحين الذين اجتازوا الاختبارات',
                'content_fr' => "<p dir='rtl' style='text-align: justify; line-height: 2;'>إعلان موجّه إلى المترشحين الذين اجتازوا الاختبارات المهنية والنفسية الخاصة بخطة عون تنظيف (رمز الخطة : <span dir='ltr'>E-D</span>) وخطة عون كهربائي وميكانيكي (رمز الخطة : <span dir='ltr'>E-B</span>). يمكن للمترشحين الاطلاع على القائمة الأولية للمقبولين عبر الموقع الإلكتروني <span dir='ltr'>www.ciok.tn</span>، كما يمكنهم تقديم اعتراض كتابي في أجل أقصاه 10 أيام من تاريخ نشر القائمة، وذلك عن طريق البريد مضمون الوصول إلى شركة إسمنت أم الكليل بالكاف.</p>",
                'image' => 'actualites/resultat-concours.jpg',
                'pdf' => 'actualites/Résultat E-D et E-B.pdf',
                'published_at' => '2026-05-12',
            ],
            [
                'title_fr' => 'Résultats du concours',
                'excerpt_fr' => 'Résultats préliminaires pour la section maîtrise',
                'content_fr' => "Les Ciments d'Oum El Kelil informe tous les candidats au concours externe des années 2022, 2023 et 2024 qu'ils peuvent consulter les résultats préliminaires pour la section maîtrise, pour les postes suivants : M-A M-S M-R M-Q M-P M-O M-N M-M M-K M-J M-I M-H M-E M-B, sur notre page officielle Facebook ainsi que sur notre site web de la société.",
                'image' => 'actualites/resultat-concours.jpg',
                'pdf' => 'actualites/Résultat concours (Partie 3).pdf',
                'published_at' => '2026-01-10',
            ],
            [
                'title_fr' => "إنجاز جديد لشركة إسمنت أم الكليل: تجديد شهادة الاعتماد لمخبر التحاليل",
                'excerpt_fr' => 'تجديد شهادة الاعتماد لمخبر التحاليل والتجارب طبقًا لأعلى المعايير الدولية',
                'content_fr' => "بكل فخر واعتزاز، تعلن \"شركة إسمنت أم الكليل\" عن تجديد شهادة الاعتماد لمخبر التحاليل والتجارب التابع لشركتنا وذلك طبقًا لمتطلبات المواصفة الوطنية م.ت 110-200 (2017) والمواصفة الدولية ISO/IEC 17025 نسخة 2017.",
                'image' => 'actualites/certificat 17025.jpg',
                'pdf' => null,
                'published_at' => '2026-02-26',
            ],
            [
                'title_fr' => 'Résultats du concours',
                'excerpt_fr' => 'Résultats préliminaires pour les postes M-C, M-F, M-D et M-G',
                'content_fr' => "Les Ciments d'Oum El Kelil informe tous les candidats au concours externe des années 2022, 2023 et 2024 qu'ils peuvent consulter les résultats préliminaires pour la section maîtrise, pour les postes suivants : M-C, M-F, M-D et M-G, sur notre page officielle Facebook ainsi que sur notre site web de la société. Les candidats aux autres postes sont informés que la commission du concours poursuit l'évaluation des dossiers.",
                'image' => 'actualites/resultat-concours.jpg',
                'pdf' => 'actualites/concours 2024 (M).pdf',
                'published_at' => '2026-01-10',
            ],
            [
                'title_fr' => 'Résultats du concours',
                'excerpt_fr' => 'Résultats des filières cadres et exécution',
                'content_fr' => "Tous les candidats au concours externe de la société Les Ciments d'Oum El Kelil pour les sessions 2022, 2023 et 2024 sont informés que les résultats des filières cadres et exécution sont affichés sur notre site web ainsi que sur notre page Facebook.",
                'image' => 'actualites/resultat-concours.jpg',
                'pdf' => 'actualites/resultat-concours.pdf',
                'published_at' => '2026-01-10',
            ],
            [
                'title_fr' => 'Les Ciments d\'Oum El Kelil obtient la certification ISO 9001:2015',
                'excerpt_fr' => 'Certification ISO 9001:2015 délivrée par AFAQ AFNOR International',
                'content_fr' => "Les Ciments d'Oum El Kelil annonce avec fierté l'obtention de la certification ISO 9001:2015, délivrée par AFAQ AFNOR International, attestant de la conformité de son système de management de la qualité aux normes internationales.",
                'image' => 'actualites/certificat.jpg',
                'pdf' => null,
                'published_at' => '2026-01-10',
            ],
            [
                'title_fr' => 'Maintien des activités d\'exportation vers la Libye pour l\'année 2026',
                'excerpt_fr' => 'Poursuite de la stratégie de présence sur les marchés régionaux',
                'content_fr' => "Les Ciments d'Oum El Kelil confirme le maintien de ses activités d'exportation vers la Libye pour l'année 2026, poursuivant ainsi sa stratégie de présence sur les marchés régionaux tout en garantissant le respect des normes de qualité et des délais de livraison.",
                'image' => 'actualites/lybia.jpg',
                'pdf' => null,
                'published_at' => '2026-01-12',
            ],
            [
                'title_fr' => 'Remplacement des manches du filtre final',
                'excerpt_fr' => 'Renforcement de la performance du système de filtration',
                'content_fr' => "Dans le cadre de son engagement en faveur de la protection de l'environnement, la Société des Ciments d'Oum El Kelil a procédé aux travaux de remplacement des manches du filtre final. Cette opération vise à renforcer la performance du système de filtration, à réduire les émissions de poussières et à assurer la conformité aux normes environnementales en vigueur.",
                'image' => 'actualites/filte.png',
                'pdf' => null,
                'published_at' => '2026-01-15',
            ],
            [
                'title_fr' => 'Encouragement des activités sportives',
                'excerpt_fr' => 'Soutien aux clubs et initiatives sportives',
                'content_fr' => "Les Ciments d'Oum El Kelil poursuit son soutien aux clubs et initiatives sportives, en apportant un appui financier et, surtout, moral.",
                'image' => 'actualites/olk.png',
                'pdf' => null,
                'published_at' => '2026-01-15',
            ],
            [
                'title_fr' => 'Phase de maintenance du four',
                'excerpt_fr' => 'Opérations de maintenance préventive et corrective sur le four',
                'content_fr' => "Opérations de maintenance préventive et corrective réalisées sur le four, incluant l'inspection des composants critiques et l'optimisation des paramètres de fonctionnement pour assurer la performance et la sécurité du process de production.",
                'image' => 'actualites/four.jpg',
                'pdf' => null,
                'published_at' => '2026-01-15',
            ],
        ];

        foreach ($posts as $data) {
            $data['slug'] = Str::slug($data['title_fr']) . '-' . uniqid();
            $data['is_published'] = true;

            Post::create($data);
        }

        $this->command->info('✅ ' . count($posts) . ' actualités importées !');
    }
}