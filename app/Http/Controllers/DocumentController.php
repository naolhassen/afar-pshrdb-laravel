<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\View\View;

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
}
