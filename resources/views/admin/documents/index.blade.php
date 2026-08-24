@extends('admin.layout')

@section('title', 'Documents')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-600">
                <i data-lucide="files" class="h-5 w-5"></i>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Documents</h1>
        </div>
        <a href="{{ route('admin.documents.create') }}" class="btn-primary w-fit">
            <i data-lucide="upload" class="h-4 w-4"></i> Upload Document
        </a>
    </div>

    @include('admin.partials.table-toolbar', [
        'filters' => $filters,
        'categoryOptions' => $categories,
    ])

    <div class="admin-card overflow-hidden animate-scale-in">
        <div class="overflow-x-auto">
            <table class="admin-table admin-table-modern w-full min-w-[720px]">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>File</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr class="group">
                            <td>
                                <div class="flex items-center gap-3">
                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-indigo-600 group-hover:bg-indigo-50 group-hover:text-indigo-700 transition">
                                        <i data-lucide="file-text" class="h-4 w-4"></i>
                                    </span>
                                    <div>
                                        <div class="font-semibold text-slate-900">{{ $document->title_en }}</div>
                                        <div class="text-xs text-slate-400">{{ $document->file_name ?: basename($document->file_url) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($document->category)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-indigo-100">
                                        <i data-lucide="folder" class="h-3 w-3"></i>
                                        {{ $document->category }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ $document->file_url }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-600 hover:text-brand-800 transition">
                                    <i data-lucide="download" class="h-3.5 w-3.5"></i>
                                    {{ $document->file_name ? 'Download' : 'View' }}
                                </a>
                            </td>
                            <td>
                                @if ($document->published)
                                    <span class="status-badge status-published">
                                        <i data-lucide="check" class="h-3 w-3"></i> Published
                                    </span>
                                @else
                                    <span class="status-badge status-draft">
                                        <i data-lucide="pencil" class="h-3 w-3"></i> Draft
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ $document->file_url }}" target="_blank" rel="noreferrer" class="btn-icon" aria-label="Download">
                                        <i data-lucide="download" class="h-4 w-4"></i>
                                    </a>
                                    <a href="{{ route('admin.documents.edit', $document) }}" class="btn-icon" aria-label="Edit">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.documents.destroy', $document) }}" class="inline" data-confirm="Delete this document?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon text-rose-600 hover:bg-rose-50" aria-label="Delete">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="inbox" class="h-10 w-10 text-slate-300"></i>
                                    <span>No documents found.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-6 py-4 bg-slate-50/50">
            {{ $documents->links() }}
        </div>
    </div>
@endsection
