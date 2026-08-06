<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/announcements.json');

        if (! File::exists($path)) {
            return;
        }

        $rows = json_decode(File::get($path), true) ?? [];

        foreach ($rows as $row) {
            DB::table('announcements')->updateOrInsert(
                ['slug' => $row['slug']],
                [
                    'date' => $row['date'],
                    'type' => strtolower($row['type']),
                    'published' => $row['published'],
                    'title_en' => $row['titleEn'],
                    'title_am' => $row['titleAm'],
                    'title_aa' => $row['titleAa'],
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
