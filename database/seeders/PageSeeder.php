<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/pages.json');

        if (! File::exists($path)) {
            return;
        }

        $rows = json_decode(File::get($path), true) ?? [];

        foreach ($rows as $row) {
            DB::table('pages')->updateOrInsert(
                ['slug' => $row['slug']],
                [
                    'published' => $row['published'],
                    'title_en' => $row['titleEn'],
                    'title_am' => $row['titleAm'],
                    'title_aa' => $row['titleAa'],
                    'content_en' => $row['contentEn'],
                    'content_am' => $row['contentAm'],
                    'content_aa' => $row['contentAa'],
                    'image_url' => $row['imageUrl'],
                    'video_url' => $row['videoUrl'],
                    'created_at' => $row['createdAt'],
                    'updated_at' => $row['updatedAt'],
                ]
            );
        }
    }
}
