@extends('admin.layout')

@section('title', 'Announcements')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-100 text-amber-600">
                <i data-lucide="megaphone" class="h-5 w-5"></i>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">Announcements</h1>
        </div>
        <a href="{{ route('admin.announcements.create') }}" class="btn-primary w-fit">
            <i data-lucide="plus" class="h-4 w-4"></i> New Announcement
        </a>
    </div>

    <div class="admin-card overflow-hidden animate-scale-in">
        <div class="overflow-x-auto">
            <table class="admin-table w-full min-w-[640px]">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $announcement)
                        <tr>
                            <td>
                                <div class="font-semibold text-slate-900">{{ $announcement->title_en }}</div>
                            </td>
                            <td>
                                <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold capitalize text-slate-600">
                                    <i data-lucide="{{ $announcement->type === 'tender' ? 'file-text' : 'megaphone' }}" class="h-3 w-3"></i>
                                    {{ $announcement->type }}
                                </span>
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5 text-slate-600">
                                    <i data-lucide="calendar" class="h-3.5 w-3.5 text-slate-400"></i>
                                    {{ $announcement->date }}
                                </div>
                            </td>
                            <td>
                                @if ($announcement->published)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-100">
                                        <i data-lucide="check" class="h-3 w-3"></i> Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700 ring-1 ring-amber-100">
                                        <i data-lucide="pencil" class="h-3 w-3"></i> Draft
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn-icon" aria-label="Edit">
                                        <i data-lucide="pencil" class="h-4 w-4"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" class="inline" data-confirm="Delete this announcement?">
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
                                    <span>No announcements yet.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-slate-100 px-6 py-4">{{ $announcements->links() }}</div>
    </div>
@endsection
