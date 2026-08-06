<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $fillable = [
        'slug',
        'date',
        'published',
        'category_en',
        'category_am',
        'category_aa',
        'title_en',
        'title_am',
        'title_aa',
        'excerpt_en',
        'excerpt_am',
        'excerpt_aa',
        'body_en',
        'body_am',
        'body_aa',
        'image_url',
        'video_url',
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
