<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class AnnouncementController extends Controller
{
    private const TYPE_SLUGS = [
        'tenders' => 'tender',
        'other' => 'other',
    ];

    public function index(string $locale, string $typeSlug): View
    {
        $type = self::TYPE_SLUGS[$typeSlug] ?? null;

        if (! $type) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $items = Announcement::published()->ofType($type)->latest('date')->get();

        return view('announcements.index', [
            'locale' => $locale,
            'typeSlug' => $typeSlug,
            'items' => $items,
        ]);
    }

    public function show(string $locale, string $typeSlug, string $slug): View
    {
        $type = self::TYPE_SLUGS[$typeSlug] ?? null;

        if (! $type) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $item = Announcement::published()
            ->ofType($type)
            ->where('slug', $slug)
            ->first();

        if (! $item) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('announcements.show', [
            'locale' => $locale,
            'typeSlug' => $typeSlug,
            'item' => $item,
        ]);
    }
}
