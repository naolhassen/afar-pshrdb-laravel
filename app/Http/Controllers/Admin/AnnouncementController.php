<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::orderByDesc('date')->paginate(15);

        return view('admin.announcements.index', ['announcements' => $announcements]);
    }

    public function create(): View
    {
        return view('admin.announcements.form', ['announcement' => new Announcement]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? null);

        Announcement::create($data);

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement created.');
    }

    public function edit(Announcement $announcement): View
    {
        return view('admin.announcements.form', ['announcement' => $announcement]);
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);
        $data['image_url'] = $this->handleImageUpload($request, $data['image_url'] ?? $announcement->image_url);

        $announcement->update($data);

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('status', 'Announcement deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'slug' => ['nullable', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'type' => ['required', 'string', 'in:tender,vacancy,other'],
            'published' => ['boolean'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_am' => ['nullable', 'string', 'max:255'],
            'title_aa' => ['nullable', 'string', 'max:255'],
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
            $path = $request->file('image')->store('announcements', 'public');

            return Storage::url($path);
        }

        return $fallback;
    }
}
