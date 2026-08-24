<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $documents = Document::query()
            ->search($request->query('search'))
            ->category($request->query('category'))
            ->when($request->query('status') !== null, function ($q) use ($request) {
                $q->where('published', $request->query('status') === 'published');
            })
            ->orderByDesc('updated_at')
            ->paginate(15)
            ->withQueryString();

        $categories = Document::query()
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('admin.documents.index', [
            'documents' => $documents,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category', 'status']),
        ]);
    }

    public function create(): View
    {
        return view('admin.documents.form', ['document' => new Document]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);

        $data = array_merge($data, $this->handleFileUpload($request, $data['file_url'] ?? null));

        Document::create($data);

        return redirect()->route('admin.documents.index')->with('status', 'Document created.');
    }

    public function edit(Document $document): View
    {
        return view('admin.documents.form', ['document' => $document]);
    }

    public function update(Request $request, Document $document): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['title_en']);

        $fileData = $this->handleFileUpload($request, $document->file_url);
        $data = array_merge($data, $fileData);

        $document->update($data);

        return redirect()->route('admin.documents.index')->with('status', 'Document updated.');
    }

    public function destroy(Document $document): RedirectResponse
    {
        if ($document->file_url && Storage::disk('public')->exists($this->relativePath($document->file_url))) {
            Storage::disk('public')->delete($this->relativePath($document->file_url));
        }

        $document->delete();

        return redirect()->route('admin.documents.index')->with('status', 'Document deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'slug' => ['nullable', 'string', 'max:255'],
            'published' => ['boolean'],
            'category' => ['nullable', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'title_am' => ['nullable', 'string', 'max:255'],
            'title_aa' => ['nullable', 'string', 'max:255'],
            'description_en' => ['nullable', 'string'],
            'description_am' => ['nullable', 'string'],
            'description_aa' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,txt,xls,xlsx,ppt,pptx,jpg,jpeg,png,webp', 'max:10240'],
            'file_url' => ['nullable', 'string'],
        ]) + ['published' => $request->boolean('published')];
    }

    private function handleFileUpload(Request $request, ?string $fallback): array
    {
        if (! $request->hasFile('file')) {
            return ['file_url' => $fallback];
        }

        $uploaded = $request->file('file');
        $path = $uploaded->store('documents', 'public');

        return [
            'file_url' => Storage::url($path),
            'file_name' => $uploaded->getClientOriginalName(),
            'file_type' => $uploaded->getClientMimeType(),
        ];
    }

    private function relativePath(string $url): string
    {
        return str_replace('/storage/', '', parse_url($url, PHP_URL_PATH) ?? '');
    }
}
