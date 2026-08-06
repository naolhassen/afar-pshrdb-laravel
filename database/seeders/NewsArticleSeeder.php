<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NewsArticleSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/news_articles.json');

        if (! File::exists($path)) {
            return;
        }

        $rows = json_decode(File::get($path), true) ?? [];

        foreach ($rows as $row) {
            DB::table('news_articles')->updateOrInsert(
                ['slug' => $row['slug']],
                [
                    'date' => $row['date'],
                    'published' => $row['published'],
                    'category_en' => $row['categoryEn'],
                    'category_am' => $row['categoryAm'],
                    'category_aa' => $row['categoryAa'],
                    'title_en' => $row['titleEn'],
                    'title_am' => $row['titleAm'],
                    'title_aa' => $row['titleAa'],
                    'excerpt_en' => $row['excerptEn'],
                    'excerpt_am' => $row['excerptAm'],
                    'excerpt_aa' => $row['excerptAa'],
                    'body_en' => $row['bodyEn'],
                    'body_am' => $row['bodyAm'],
                    'body_aa' => $row['bodyAa'],
                    'image_url' => $row['imageUrl'],
                    'video_url' => $row['videoUrl'],
                    'created_at' => $row['createdAt'],
                    'updated_at' => $row['updatedAt'],
                ]
            );
        }
    }
}
