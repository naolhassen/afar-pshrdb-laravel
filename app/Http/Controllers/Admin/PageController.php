<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(Request $request): View
    {
        $pages = Page::query()
            ->when($request->query('search'), function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('title_en', 'like', "%{$search}%")
                      ->orWhere('title_am', 'like', "%{$search}%")
                      ->orWhere('title_aa', 'like', "%{$search}%")
                      ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($request->query('status') !== null, function ($q) use ($request) {
                $q->where('published', $request->query('status') === 'published');
            })
            ->orderBy('slug')
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.index', [
            'pages' => $pages,
            'filters' => $request->only(['search', 'status']),
            'categories' => collect(),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.form', ['page' => new Page]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? null);

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('status', 'Page created.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.form', ['page' => $page]);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? $page->image_url);

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('status', 'Page updated.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('status', 'Page deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'slug' => ['nullable', 'string', 'max:255'],
            'published' => ['boolean'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_am' => ['nullable', 'string', 'max:255'],
            'title_aa' => ['nullable', 'string', 'max:255'],
            'content_en' => ['nullable', 'string'],
            'content_am' => ['nullable', 'string'],
            'content_aa' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
            'image_url' => ['nullable', 'string'],
            'video_url' => ['nullable', 'string', 'max:2048'],
        ]) + ['published' => $request->boolean('published')];
    }

    private function handleImageUpload(Request $request, ?string $fallback): ?string
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('pages', 'public');

            return Storage::url($path);
        }

        return $fallback;
    }
}
