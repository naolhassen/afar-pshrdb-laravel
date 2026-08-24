<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsArticleController extends Controller
{
    public function index(Request $request): View
    {
        $categories = NewsArticle::query()->whereNotNull('category_en')->distinct()->pluck('category_en');

        $articles = NewsArticle::query()
            ->when($request->query('search'), function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('title_en', 'like', "%{$search}%")
                      ->orWhere('title_am', 'like', "%{$search}%")
                      ->orWhere('title_aa', 'like', "%{$search}%")
                      ->orWhere('body_en', 'like', "%{$search}%")
                      ->orWhere('body_am', 'like', "%{$search}%")
                      ->orWhere('body_aa', 'like', "%{$search}%");
                });
            })
            ->when($request->query('category'), function ($q, $category) {
                $q->where('category_en', $category);
            })
            ->when($request->query('status') !== null, function ($q) use ($request) {
                $q->where('published', $request->query('status') === 'published');
            })
            ->orderByDesc('date')
            ->paginate(15)
            ->withQueryString();

        return view('admin.news.index', [
            'articles' => $articles,
            'filters' => $request->only(['search', 'category', 'status']),
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        return view('admin.news.form', ['article' => new NewsArticle]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? null);

        NewsArticle::create($data);

        return redirect()->route('admin.news.index')->with('status', 'News article created.');
    }

    public function edit(NewsArticle $news): View
    {
        return view('admin.news.form', ['article' => $news]);
    }

    public function update(Request $request, NewsArticle $news): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? $news->image_url);

        $news->update($data);

        return redirect()->route('admin.news.index')->with('status', 'News article updated.');
    }

    public function destroy(NewsArticle $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('status', 'News article deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'slug' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'published' => ['boolean'],
            'category_en' => ['nullable', 'string', 'max:255'],
            'category_am' => ['nullable', 'string', 'max:255'],
            'category_aa' => ['nullable', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_am' => ['nullable', 'string', 'max:255'],
            'title_aa' => ['nullable', 'string', 'max:255'],
            'excerpt_en' => ['nullable', 'string'],
            'excerpt_am' => ['nullable', 'string'],
            'excerpt_aa' => ['nullable', 'string'],
            'body_en' => ['nullable', 'string'],
            'body_am' => ['nullable', 'string'],
            'body_aa' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'image_url' => ['nullable', 'string'],
            'video_url' => ['nullable', 'string', 'max:2048'],
        ]) + ['published' => $request->boolean('published')];
    }

    private function handleImageUpload(Request $request, ?string $fallback): ?string
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news', 'public');

            return Storage::url($path);
        }

        return $fallback;
    }
}
