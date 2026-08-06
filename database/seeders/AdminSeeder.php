<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/admins.json');

        if (! File::exists($path)) {
            return;
        }

        $rows = json_decode(File::get($path), true) ?? [];

        foreach ($rows as $row) {
            // The exported passwordHash is already a bcrypt hash from the
            // legacy Next.js app (bcryptjs), which is binary-compatible
            // with Laravel's bcrypt driver, so we store it verbatim via
            // the query builder to bypass the model's "hashed" cast.
            DB::table('admins')->updateOrInsert(
                ['email' => $row['email']],
                [
                    'name' => $row['name'],
                    'password' => $row['passwordHash'],
                    'created_at' => $row['createdAt'],
                    'updated_at' => $row['createdAt'],
                ]
            );
        }
    }
}
