@extends('admin.layout')

@section('title', 'Pages')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-600">
                <i data-lucide="file-text" class="h-5 w-5"></i>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Pages</h1>
        </div>
        <a href="{{ route('admin.pages.create') }}" class="btn-primary w-fit">
            <i data-lucide="plus" class="h-4 w-4"></i> New Page
        </a>
    </div>

    @include('admin.partials.table-toolbar', ['filters' => $filters, 'categoryOptions' => $categories])

    <div class="admin-card overflow-hidden animate-scale-in" data-admin-table>
        <div class="overflow-x-auto">
            <table class="admin-table w-full min-w-[640px]">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr class="group">
                            <td>
                                <div class="font-semibold text-slate-900">{{ $page->title_en }}</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5 text-slate-600">
                                    <i data-lucide="link" class="h-3.5 w-3.5 text-slate-400"></i>
                                    {{ $page->slug }}
                                </div>
                            </td>
                            <td>
                                @if ($page->published)
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
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn-icon text-brand-600 hover:border-brand-200 hover:bg-brand-50" aria-label="Edit">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="inline" data-confirm="Delete this page?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon text-rose-600 hover:border-rose-200 hover:bg-rose-50" aria-label="Delete">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-slate-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="inbox" class="h-10 w-10 text-slate-300"></i>
                                    <span>No pages yet.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-pagination border-t border-slate-100 px-6 py-4">{{ $pages->links() }}</div>
    </div>

    <div class="admin-card overflow-hidden hidden" data-admin-skeleton>
        <div class="overflow-x-auto">
            <table class="admin-table w-full min-w-[640px]">
                <thead>
                    <tr>
                        <th class="w-full">Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('admin.partials.table-skeleton', ['cols' => 4])
                </tbody>
            </table>
        </div>
    </div>
@endsection
