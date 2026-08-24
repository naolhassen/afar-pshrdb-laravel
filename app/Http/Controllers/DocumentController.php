<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    public function index(string $locale): View
    {
        $documents = Document::published()->orderByDesc('updated_at')->get();

        return view('documents.index', [
            'locale' => $locale,
            'documents' => $documents,
        ]);
    }

    public function download(string $locale, Document $document): StreamedResponse
    {
        $path = $document->filePath();

        if (! $path || ! Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download($path, $document->file_name ?: basename($path));
    }

    public function read(string $locale, Document $document): StreamedResponse
    {
        $path = $document->filePath();

        if (! $path || ! Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->response($path);
    }
}
