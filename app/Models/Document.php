<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasLocalizedFields;

    protected $fillable = [
        'slug',
        'published',
        'category',
        'title_en',
        'title_am',
        'title_aa',
        'description_en',
        'description_am',
        'description_aa',
        'file_name',
        'file_url',
        'file_type',
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

    public function scopeCategory(Builder $query, ?string $category): Builder
    {
        return $category
            ? $query->where('category', $category)
            : $query;
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $search
            ? $query->where(function (Builder $q) use ($search) {
                $q->where('title_en', 'like', "%{$search}%")
                  ->orWhere('title_am', 'like', "%{$search}%")
                  ->orWhere('title_aa', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            })
            : $query;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function filePath(): ?string
    {
        if (! $this->file_url) {
            return null;
        }

        $path = parse_url($this->file_url, PHP_URL_PATH) ?? $this->file_url;
        $path = ltrim($path, '/');

        return preg_replace('#^storage/#', '', $path);
    }
}
