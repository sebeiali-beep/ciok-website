<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $ciments = Category::where('slug', 'ciments')->first();
        $chaux = Category::where('slug', 'chaux')->first();
        $clinker = Category::where('slug', 'clinker')->first();

        $products = [
            [
                'category_id' => $ciments->id,
                'name_fr' => 'CEM I 42.5 N',
                'name_ar' => 'CEM I 42.5 N',
                'name_en' => 'CEM I 42.5 N',
                'slug' => 'cem-i-42-5-n',
                'description_fr' => 'Ciment Portland artificiel de classe 42.5 N. Idéal pour les travaux de maçonnerie, béton armé et ouvrages d\'art. Résistance élevée et prise régulière.',
                'description_ar' => 'أسمنت بورتلاند اصطناعي من فئة 42.5 N. مثالي لأعمال البناء والخرسانة المسلحة والمنشآت الفنية.',
                'description_en' => 'Artificial Portland cement class 42.5 N. Ideal for masonry, reinforced concrete and civil engineering works.',
                'specifications_fr' => "Résistance : 42.5 MPa à 28 jours\nClasse : CEM I 42.5 N\nNorme : NT 47.01 / EN 197-1\nConditionnement : Sacs de 50 kg",
                'specifications_ar' => "المقاومة: 42.5 ميجا باسكال في 28 يوما\nالفئة: CEM I 42.5 N\nالتعبئة: أكياس 50 كغ",
                'specifications_en' => "Strength: 42.5 MPa at 28 days\nClass: CEM I 42.5 N\nStandard: NT 47.01 / EN 197-1\nPackaging: 50 kg bags",
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'category_id' => $ciments->id,
                'name_fr' => 'CEM II/A 32.5 R',
                'name_ar' => 'CEM II/A 32.5 R',
                'name_en' => 'CEM II/A 32.5 R',
                'slug' => 'cem-ii-a-32-5-r',
                'description_fr' => 'Ciment Portland composé à base de calcaire. Polyvalent et économique, adapté aux travaux courants de construction.',
                'description_ar' => 'أسمنت بورتلاند المركب على أساس الحجر الجيري. متعدد الاستخدامات واقتصادي.',
                'description_en' => 'Composite Portland cement based on limestone. Versatile and economical.',
                'specifications_fr' => "Résistance : 32.5 MPa à 28 jours\nClasse : CEM II/A 32.5 R\nNorme : NT 47.01 / EN 197-1\nConditionnement : Sacs de 50 kg",
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'category_id' => $ciments->id,
                'name_fr' => 'CEM II/B 42.5 N',
                'name_ar' => 'CEM II/B 42.5 N',
                'name_en' => 'CEM II/B 42.5 N',
                'slug' => 'cem-ii-b-42-5-n',
                'description_fr' => 'Ciment composé haute performance. Adapté aux bétons de structure et aux environnements agressifs.',
                'description_ar' => 'أسمنت مركب عالي الأداء. مناسب للخرسانة الهيكلية والبيئات العدوانية.',
                'description_en' => 'High-performance composite cement. Suitable for structural concrete and aggressive environments.',
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'category_id' => $chaux->id,
                'name_fr' => 'Chaux hydraulique NHL 5',
                'name_ar' => 'الجير الهيدروليكي NHL 5',
                'name_en' => 'Hydraulic lime NHL 5',
                'slug' => 'chaux-hydraulique-nhl-5',
                'description_fr' => 'Chaux hydraulique naturelle pour la restauration du patrimoine et les enduits traditionnels.',
                'description_ar' => 'الجير الهيدروليكي الطبيعي لترميم التراث والملاط التقليدي.',
                'description_en' => 'Natural hydraulic lime for heritage restoration and traditional coatings.',
                'is_featured' => false,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'category_id' => $chaux->id,
                'name_fr' => 'Chaux aérienne CL 90',
                'name_ar' => 'الجير الهوائي CL 90',
                'name_en' => 'Air lime CL 90',
                'slug' => 'chaux-aerienne-cl-90',
                'description_fr' => 'Chaux aérienne calcique de haute pureté pour usages agricoles et industriels.',
                'description_ar' => 'الجير الهوائي الكلسي عالي النقاء للاستخدامات الزراعية والصناعية.',
                'description_en' => 'High-purity calcic air lime for agricultural and industrial uses.',
                'is_featured' => false,
                'is_active' => true,
                'order' => 5,
            ],
            [
                'category_id' => $clinker->id,
                'name_fr' => 'Clinker Portland',
                'name_ar' => 'الكلنكر البورتلاندي',
                'name_en' => 'Portland Clinker',
                'slug' => 'clinker-portland',
                'description_fr' => 'Clinker de ciment Portland destiné à la production de ciments composés et à l\'exportation.',
                'description_ar' => 'كلنكر أسمنت بورتلاند لإنتاج الأسمنت المركب والتصدير.',
                'description_en' => 'Portland cement clinker for the production of composite cements and export.',
                'is_featured' => false,
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}