<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(string $locale): View
    {
        $latestNews = NewsArticle::published()
            ->latest('date')
            ->take(6)
            ->get();

        $leaders = collect(config('leaders'))->map(fn (array $leader) => [
            'key' => $leader['key'],
            'name' => $leader['name'][$locale] ?? $leader['name']['en'],
            'role' => $leader['role'][$locale] ?? $leader['role']['en'],
            'image' => $leader['image'],
        ]);

        $head = $leaders->firstWhere('key', 'head');

        $stats = [
            ['value' => '180,078', 'label' => 'Total Public Servants'],
            ['value' => '77,303', 'label' => 'Male Public Servants'],
            ['value' => '102,775', 'label' => 'Female Public Servants'],
        ];

        return view('home', [
            'locale' => $locale,
            'latestNews' => $latestNews,
            'leaders' => $leaders,
            'head' => $head,
            'stats' => $stats,
        ]);
    }
}
