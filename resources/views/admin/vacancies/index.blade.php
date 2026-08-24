@extends('admin.layout')

@section('title', 'Vacancies')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                <i data-lucide="briefcase" class="h-5 w-5"></i>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Vacancies</h1>
        </div>
        <a href="{{ route('admin.vacancies.create') }}" class="btn-primary w-fit">
            <i data-lucide="plus" class="h-4 w-4"></i> New Vacancy
        </a>
    </div>

    @include('admin.partials.table-toolbar', ['filters' => $filters, 'categoryOptions' => $categories])

    <div class="admin-card overflow-hidden animate-scale-in">
        <div class="overflow-x-auto">
            <table class="admin-table w-full min-w-[640px]">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vacancies as $vacancy)
                        <tr class="group">
                            <td>
                                <div class="font-semibold text-slate-900">{{ $vacancy->title_en }}</div>
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5 text-slate-600">
                                    <i data-lucide="calendar-clock" class="h-3.5 w-3.5 text-slate-400"></i>
                                    {{ $vacancy->deadline }}
                                </div>
                            </td>
                            <td>
                                @if ($vacancy->published)
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
                                    <a href="{{ route('admin.vacancies.edit', $vacancy) }}" class="btn-icon" aria-label="Edit">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.vacancies.destroy', $vacancy) }}" class="inline" data-confirm="Delete this vacancy?">
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
                            <td colspan="4" class="py-10 text-center text-slate-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i data-lucide="inbox" class="h-10 w-10 text-slate-300"></i>
                                    <span>No vacancies yet.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-6 py-4">{{ $vacancies->links() }}</div>
    </div>
@endsection
