@extends('admin.layout')

@section('title', 'News Articles')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">News Articles</h1>
        <a href="{{ route('admin.news.create') }}" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-4 py-2 text-sm font-medium">
            New Article
        </a>
    </div>

    <div class="bg-white rounded-lg shadow divide-y">
        @forelse ($articles as $article)
            <div class="flex items-center justify-between p-4">
                <div>
                    <div class="font-medium">{{ $article->title_en }}</div>
                    <div class="text-xs text-gray-500">
                        {{ $article->date }} &middot; {{ $article->published ? 'Published' : 'Draft' }}
                    </div>
                </div>
                <div class="flex gap-3 text-sm">
                    <a href="{{ route('admin.news.edit', $article) }}" class="text-brand-700 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.news.destroy', $article) }}"
                          onsubmit="return confirm('Delete this article?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">No news articles yet.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $articles->links() }}</div>
@endsection
