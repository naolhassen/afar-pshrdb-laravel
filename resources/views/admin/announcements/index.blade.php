@extends('admin.layout')

@section('title', 'Announcements')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Announcements</h1>
        <a href="{{ route('admin.announcements.create') }}" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-4 py-2 text-sm font-medium">
            New Announcement
        </a>
    </div>

    <div class="bg-white rounded-lg shadow divide-y">
        @forelse ($announcements as $announcement)
            <div class="flex items-center justify-between p-4">
                <div>
                    <div class="font-medium">{{ $announcement->title_en }}</div>
                    <div class="text-xs text-gray-500">
                        {{ $announcement->type }} &middot; {{ $announcement->date }} &middot;
                        {{ $announcement->published ? 'Published' : 'Draft' }}
                    </div>
                </div>
                <div class="flex gap-3 text-sm">
                    <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-brand-700 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}"
                          onsubmit="return confirm('Delete this announcement?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">No announcements yet.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $announcements->links() }}</div>
@endsection
