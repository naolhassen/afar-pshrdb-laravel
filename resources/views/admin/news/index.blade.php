@extends('admin.layout')

@section('title', 'News Articles')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-brand-500 to-brand-700 text-white shadow-md">
                <i data-lucide="newspaper" class="h-5 w-5"></i>
            </span>
            <div>
                <h1 class="text-2xl font-bold text-slate-900">News Articles</h1>
                <p class="text-sm text-slate-500">Manage and publish bureau news</p>
            </div>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn-primary w-fit">
            <i data-lucide="plus" class="h-4 w-4"></i> New Article
        </a>
    </div>

    @include('admin.partials.table-toolbar', ['filters' => $filters, 'categoryOptions' => $categories])

    <div class="admin-card overflow-hidden animate-scale-in" data-admin-table>
        <div class="overflow-x-auto">
            <table class="admin-table w-full min-w-[640px]">
                <thead>
                    <tr>
                        <th class="w-full">Title</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articles as $article)
                        <tr class="group">
                            <td>
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                        <i data-lucide="newspaper" class="h-4 w-4"></i>
                                    </span>
                                    <div>
                                        <div class="font-semibold text-slate-900">{{ $article->title_en }}</div>
                                        <div class="text-xs text-slate-500">{{ $article->category_en ?: '—' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5 text-slate-600">
                                    <i data-lucide="calendar" class="h-3.5 w-3.5 text-slate-400"></i>
                                    {{ $article->date }}
                                </div>
                            </td>
                            <td>
                                @if ($article->published)
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
                                    <a href="{{ route('admin.news.edit', $article) }}" class="btn-icon text-brand-600 hover:border-brand-200 hover:bg-brand-50" aria-label="Edit">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.news.destroy', $article) }}" class="inline" data-confirm="Delete this article?">
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
                            <td colspan="4" class="py-14 text-center text-slate-500">
                                <div class="flex flex-col items-center gap-3">
                                    <span class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100">
                                        <i data-lucide="inbox" class="h-8 w-8 text-slate-300"></i>
                                    </span>
                                    <p class="font-medium text-slate-600">No news articles found.</p>
                                    <p class="text-sm text-slate-400">Try adjusting the filters or create a new article.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-pagination border-t border-slate-100 px-6 py-4">
            {{ $articles->links() }}
        </div>
    </div>

    <div class="admin-card overflow-hidden hidden" data-admin-skeleton>
        <div class="overflow-x-auto">
            <table class="admin-table w-full min-w-[640px]">
                <thead>
                    <tr>
                        <th class="w-full">Title</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @include('admin.partials.table-skeleton')
                </tbody>
            </table>
        </div>
    </div>
@endsection
