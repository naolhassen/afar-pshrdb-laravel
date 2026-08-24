<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasLocalizedFields;

    protected $fillable = [
        'slug',
        'published',
        'deadline',
        'title_en',
        'title_am',
        'title_aa',
        'description_en',
        'description_am',
        'description_aa',
        'requirements_en',
        'requirements_am',
        'requirements_aa',
        'image_url',
    ];

    protected function casts(): array
    {
        return [
            'published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }
}
