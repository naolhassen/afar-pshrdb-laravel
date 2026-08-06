<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasLocalizedFields;

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

    private const IMAGE_URL_PATTERN = '/((?:https?:\/\/[^\s"\']+|\/[^\s"\']+)\.(?:jpg|jpeg|png|webp|gif|svg)(?:\?[^\s"\']*)?)/i';

    /**
     * Extract inline image URLs referenced in the localized body text,
     * combined with the main image_url, de-duplicated.
     *
     * @return list<string>
     */
    public function imageSlides(string $locale): array
    {
        $body = $this->localized('body', $locale);
        preg_match_all(self::IMAGE_URL_PATTERN, $body, $matches);

        $urls = $this->image_url ? [$this->image_url] : [];

        return array_values(array_unique(array_merge($urls, $matches[1] ?? [])));
    }

    /**
     * Return the localized body split into paragraphs with any inline
     * image URLs stripped out.
     *
     * @return list<string>
     */
    public function bodyParagraphs(string $locale): array
    {
        $paragraphs = $this->localizedParagraphs('body', $locale);

        return array_values(array_filter(array_map(
            fn (string $p) => trim(preg_replace(self::IMAGE_URL_PATTERN, '', $p)),
            $paragraphs
        )));
    }
}
