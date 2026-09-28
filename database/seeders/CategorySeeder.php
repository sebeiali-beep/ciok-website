<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        if (Category::count() > 0) {
            $this->command->info('CategorySeeder: catégories existent déjà, ignoré.');
            return;
        }

        $categories = [
            [
                'name_fr' => 'Ciments',
                'name_ar' => 'الأسمنت',
                'name_en' => 'Cements',
                'slug' => 'ciments',
                'description_fr' => 'Notre gamme complète de ciments conformes aux normes tunisiennes et européennes.',
                'description_ar' => 'مجموعتنا الكاملة من الأسمنت المطابقة للمعايير التونسية والأوروبية.',
                'description_en' => 'Our complete range of cements complying with Tunisian and European standards.',
            ],
            [
                'name_fr' => 'Chaux',
                'name_ar' => 'الجير',
                'name_en' => 'Lime',
                'slug' => 'chaux',
                'description_fr' => 'Chaux hydraulique et aérienne pour la construction et l\'agriculture.',
                'description_ar' => 'الجير الهيدروليكي والهوائي للبناء والزراعة.',
                'description_en' => 'Hydraulic and air lime for construction and agriculture.',
            ],
            [
                'name_fr' => 'Clinker',
                'name_ar' => 'الكلنكر',
                'name_en' => 'Clinker',
                'slug' => 'clinker',
                'description_fr' => 'Clinker de haute qualité pour la production de ciment.',
                'description_ar' => 'الكلنكر عالي الجودة لإنتاج الأسمنت.',
                'description_en' => 'High-quality clinker for cement production.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $this->command->info('CategorySeeder: 3 catégories créées.');
    }
}