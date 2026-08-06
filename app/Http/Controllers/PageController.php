<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(string $locale): View
    {
        return view('pages.about', ['locale' => $locale]);
    }

    public function services(string $locale): View
    {
        return view('pages.services', ['locale' => $locale]);
    }

    public function contact(string $locale): View
    {
        return view('pages.contact', ['locale' => $locale]);
    }

    public function staticPage(string $locale, string $slug, string $fallbackTitleKey): View
    {
        $page = Page::published()->where('slug', $slug)->first();

        $title = $page ? $page->localized('title', $locale) : __($fallbackTitleKey);
        $content = $page ? $page->localizedParagraphs('content', $locale) : [];

        return view('pages.static', [
            'locale' => $locale,
            'title' => $title,
            'content' => $content,
            'imageUrl' => $page->image_url ?? null,
            'videoUrl' => $page->video_url ?? null,
        ]);
    }
}
