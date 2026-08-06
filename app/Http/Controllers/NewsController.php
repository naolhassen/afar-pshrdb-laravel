<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function index(string $locale): View
    {
        $articles = NewsArticle::published()->latest('date')->get();

        return view('news.index', [
            'locale' => $locale,
            'articles' => $articles,
        ]);
    }

    public function show(string $locale, string $slug): View
    {
        $article = NewsArticle::published()->where('slug', $slug)->first();

        if (! $article) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $latest = NewsArticle::published()
            ->where('slug', '!=', $slug)
            ->latest('date')
            ->take(4)
            ->get();

        $related = NewsArticle::published()
            ->where('slug', '!=', $slug)
            ->where('category_en', $article->category_en)
            ->latest('date')
            ->take(3)
            ->get();

        return view('news.show', [
            'locale' => $locale,
            'article' => $article,
            'latest' => $latest,
            'related' => $related,
        ]);
    }
}
