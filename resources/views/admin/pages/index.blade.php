@extends('admin.layout')

@section('title', 'Pages')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Pages</h1>
        <a href="{{ route('admin.pages.create') }}" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-4 py-2 text-sm font-medium">
            New Page
        </a>
    </div>

    <div class="bg-white rounded-lg shadow divide-y">
        @forelse ($pages as $page)
            <div class="flex items-center justify-between p-4">
                <div>
                    <div class="font-medium">{{ $page->title_en }}</div>
                    <div class="text-xs text-gray-500">
                        {{ $page->slug }} &middot; {{ $page->published ? 'Published' : 'Draft' }}
                    </div>
                </div>
                <div class="flex gap-3 text-sm">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="text-brand-700 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}"
                          onsubmit="return confirm('Delete this page?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">No pages yet.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $pages->links() }}</div>
@endsection
