<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VacancySeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/vacancies.json');

        if (! File::exists($path)) {
            return;
        }

        $rows = json_decode(File::get($path), true) ?? [];

        foreach ($rows as $row) {
            DB::table('vacancies')->updateOrInsert(
                ['slug' => $row['slug']],
                [
                    'published' => $row['published'],
                    'deadline' => $row['deadline'],
                    'title_en' => $row['titleEn'],
                    'title_am' => $row['titleAm'],
                    'title_aa' => $row['titleAa'],
                    'description_en' => $row['descriptionEn'],
                    'description_am' => $row['descriptionAm'],
                    'description_aa' => $row['descriptionAa'],
                    'requirements_en' => $row['requirementsEn'],
                    'requirements_am' => $row['requirementsAm'],
                    'requirements_aa' => $row['requirementsAa'],
                    'created_at' => $row['createdAt'],
                    'updated_at' => $row['updatedAt'],
                ]
            );
        }
    }
}
