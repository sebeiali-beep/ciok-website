<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title_fr' => 'CIOK annonce une augmentation de sa production pour 2024',
                'title_ar' => 'CIOK تعلن عن زيادة في إنتاجها لعام 2024',
                'title_en' => 'CIOK announces production increase for 2024',
                'slug' => 'augmentation-production-2024',
                'excerpt_fr' => 'L\'entreprise prévoit une hausse de 15% de sa production annuelle grâce à la modernisation de ses équipements.',
                'excerpt_ar' => 'تتوقع الشركة زيادة بنسبة 15٪ في إنتاجها السنوي بفضل تحديث معداتها.',
                'excerpt_en' => 'The company expects a 15% increase in annual production thanks to equipment modernization.',
                'content_fr' => "CIOK (Les Ciments d'Oum El Kelil) annonce une augmentation significative de sa production pour l'année 2024.\n\nCette croissance s'explique par la modernisation continue de ses lignes de production et l'optimisation de ses procédés industriels. L'entreprise prévoit ainsi de répondre à la demande croissante du marché national en matériaux de construction.\n\n« Notre priorité reste la satisfaction de nos clients et la qualité de nos produits », a déclaré la direction générale.",
                'content_ar' => "تعلن شركة CIOK (إسمنت أم الكليل) عن زيادة كبيرة في إنتاجها لعام 2024.\n\nيعزى هذا النمو إلى التحديث المستمر لخطوط الإنتاج وتحسين العمليات الصناعية.",
                'content_en' => "CIOK (Ciments d'Oum El Kelil) announces a significant increase in production for 2024.\n\nThis growth is explained by the continuous modernization of its production lines.",
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title_fr' => 'Nouvelle certification ISO 9001 pour CIOK',
                'title_ar' => 'شهادة ISO 9001 جديدة لشركة CIOK',
                'title_en' => 'New ISO 9001 certification for CIOK',
                'slug' => 'certification-iso-9001',
                'excerpt_fr' => 'L\'entreprise renouvelle sa certification ISO 9001, confirmant son engagement pour la qualité.',
                'excerpt_ar' => 'تجدد الشركة شهادة ISO 9001، مؤكدة التزامها بالجودة.',
                'excerpt_en' => 'The company renews its ISO 9001 certification, confirming its commitment to quality.',
                'content_fr' => "CIOK a récemment renouvelé sa certification ISO 9001, confirmant ainsi son engagement constant en faveur de la qualité et de l'amélioration continue.\n\nCette certification témoigne du respect rigoureux des normes internationales dans tous les processus de production, du contrôle qualité à la livraison client.",
                'content_ar' => "جددت شركة CIOK مؤخرًا شهادتها ISO 9001، مؤكدة التزامها المستمر بالجودة والتحسين المستمر.",
                'content_en' => "CIOK has recently renewed its ISO 9001 certification, confirming its constant commitment to quality and continuous improvement.",
                'is_published' => true,
                'published_at' => now()->subDays(15),
            ],
            [
                'title_fr' => 'CIOK participe au Salon International de la Construction',
                'title_ar' => 'CIOK تشارك في المعرض الدولي للبناء',
                'title_en' => 'CIOK participates in the International Construction Fair',
                'slug' => 'salon-international-construction',
                'excerpt_fr' => 'Retrouvez CIOK au salon international de la construction à Tunis du 15 au 18 mai.',
                'excerpt_ar' => 'زوروا جناح CIOK في المعرض الدولي للبناء بتونس من 15 إلى 18 مايو.',
                'excerpt_en' => 'Find CIOK at the international construction fair in Tunis from May 15 to 18.',
                'content_fr' => "CIOK sera présent au Salon International de la Construction qui se tiendra à Tunis du 15 au 18 mai.\n\nL'occasion pour l'entreprise de présenter ses nouvelles gammes de produits et d'échanger avec ses partenaires et clients. Notre équipe commerciale vous accueillera sur notre stand.",
                'content_ar' => "ستكون CIOK حاضرة في المعرض الدولي للبناء الذي سيقام بتونس من 15 إلى 18 مايو.",
                'content_en' => "CIOK will be present at the International Construction Fair to be held in Tunis from May 15 to 18.",
                'is_published' => true,
                'published_at' => now()->subDays(30),
            ],
            [
                'title_fr' => 'Engagement environnemental : réduction de notre empreinte carbone',
                'title_ar' => 'الالتزام البيئي: تقليل بصمتنا الكربونية',
                'title_en' => 'Environmental commitment: reducing our carbon footprint',
                'slug' => 'engagement-environnemental',
                'excerpt_fr' => 'CIOK renforce ses efforts pour réduire son impact environnemental avec de nouveaux investissements verts.',
                'excerpt_ar' => 'تعزز CIOK جهودها لتقليل تأثيرها البيئي من خلال استثمارات خضراء جديدة.',
                'excerpt_en' => 'CIOK strengthens its efforts to reduce its environmental impact with new green investments.',
                'content_fr' => "CIOK s'engage résolument dans une démarche de développement durable.\n\nL'entreprise investit dans des technologies propres pour réduire ses émissions de CO2 et optimiser sa consommation énergétique. Ces efforts s'inscrivent dans le cadre de la transition écologique du secteur industriel tunisien.",
                'content_ar' => "تلتزم CIOK بثبات في نهج التنمية المستدامة.",
                'content_en' => "CIOK is firmly committed to sustainable development.",
                'is_published' => true,
                'published_at' => now()->subDays(45),
            ],
            [
                'title_fr' => 'Recrutement : CIOK recrute des ingénieurs et techniciens',
                'title_ar' => 'التوظيف: CIOK توظف مهندسين وتقنيين',
                'title_en' => 'Recruitment: CIOK is hiring engineers and technicians',
                'slug' => 'recrutement-ingenieurs-techniciens',
                'excerpt_fr' => 'Plusieurs postes à pourvoir dans les domaines de la production, la maintenance et la qualité.',
                'excerpt_ar' => 'عدة مناصب شاغرة في مجالات الإنتاج والصيانة والجودة.',
                'excerpt_en' => 'Several positions available in production, maintenance and quality.',
                'content_fr' => "Dans le cadre de son développement, CIOK recrute plusieurs ingénieurs et techniciens pour ses sites de production.\n\nLes postes concernent les domaines de la production, la maintenance industrielle et le contrôle qualité. Les candidats intéressés sont invités à envoyer leur CV à rh@ciok.tn.",
                'content_ar' => "في إطار تطويرها، توظف CIOK عدة مهندسين وتقنيين لمواقع إنتاجها.",
                'content_en' => "As part of its development, CIOK is recruiting several engineers and technicians for its production sites.",
                'is_published' => true,
                'published_at' => now()->subDays(60),
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}