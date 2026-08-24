<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class VacancyController extends Controller
{
    public function index(Request $request): View
    {
        $vacancies = Vacancy::query()
            ->when($request->query('search'), function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('title_en', 'like', "%{$search}%")
                      ->orWhere('title_am', 'like', "%{$search}%")
                      ->orWhere('title_aa', 'like', "%{$search}%")
                      ->orWhere('description_en', 'like', "%{$search}%");
                });
            })
            ->when($request->query('status') !== null, function ($q) use ($request) {
                $q->where('published', $request->query('status') === 'published');
            })
            ->orderByDesc('deadline')
            ->paginate(15)
            ->withQueryString();

        return view('admin.vacancies.index', [
            'vacancies' => $vacancies,
            'filters' => $request->only(['search', 'status']),
            'categories' => collect(),
        ]);
    }

    public function create(): View
    {
        return view('admin.vacancies.form', ['vacancy' => new Vacancy]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? null);

        Vacancy::create($data);

        return redirect()->route('admin.vacancies.index')->with('status', 'Vacancy created.');
    }

    public function edit(Vacancy $vacancy): View
    {
        return view('admin.vacancies.form', ['vacancy' => $vacancy]);
    }

    public function update(Request $request, Vacancy $vacancy): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? $vacancy->image_url);

        $vacancy->update($data);

        return redirect()->route('admin.vacancies.index')->with('status', 'Vacancy updated.');
    }

    public function destroy(Vacancy $vacancy): RedirectResponse
    {
        if ($vacancy->image_url && Storage::disk('public')->exists($this->relativePath($vacancy->image_url))) {
            Storage::disk('public')->delete($this->relativePath($vacancy->image_url));
        }

        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')->with('status', 'Vacancy deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'slug' => ['nullable', 'string', 'max:255'],
            'deadline' => ['required', 'date'],
            'published' => ['boolean'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_am' => ['nullable', 'string', 'max:255'],
            'title_aa' => ['nullable', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'description_am' => ['nullable', 'string'],
            'description_aa' => ['nullable', 'string'],
            'requirements_en' => ['nullable', 'string'],
            'requirements_am' => ['nullable', 'string'],
            'requirements_aa' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'image_url' => ['nullable', 'string'],
        ]) + ['published' => $request->boolean('published')];
    }

    private function handleImageUpload(Request $request, ?string $fallback): ?string
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('vacancies', 'public');

            return Storage::url($path);
        }

        return $fallback;
    }

    private function relativePath(string $url): string
    {
        return str_replace('/storage/', '', parse_url($url, PHP_URL_PATH) ?? '');
    }
}
