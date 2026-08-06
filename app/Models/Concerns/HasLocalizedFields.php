<?php

namespace App\Models\Concerns;

trait HasLocalizedFields
{
    /**
     * Resolve a localized value for the given base field name (without the
     * _en/_am/_aa suffix), falling back through the other locales in the
     * same order used by the legacy Next.js site.
     */
    public function localized(string $field, string $locale): string
    {
        $order = match ($locale) {
            'am' => ['am', 'en', 'aa'],
            'aa' => ['aa', 'en', 'am'],
            default => ['en', 'am', 'aa'],
        };

        foreach ($order as $suffix) {
            $value = $this->{"{$field}_{$suffix}"} ?? '';
            if (trim($value) !== '') {
                return $value;
            }
        }

        return $this->{"{$field}_en"} ?? '';
    }

    /**
     * Split a localized long-text field into non-empty paragraphs on
     * blank lines, matching the legacy body-splitting behavior.
     *
     * @return list<string>
     */
    public function localizedParagraphs(string $field, string $locale): array
    {
        $text = $this->localized($field, $locale);

        return array_values(array_filter(array_map(
            fn (string $p) => trim($p),
            preg_split('/\n\s*\n/', $text) ?: []
        )));
    }
}
