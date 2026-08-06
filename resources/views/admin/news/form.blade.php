@extends('admin.layout')

@section('title', $article->exists ? 'Edit Article' : 'New Article')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ $article->exists ? 'Edit Article' : 'New Article' }}</h1>

    @if ($errors->any())
        <div class="mb-4 rounded bg-red-100 text-red-800 px-4 py-3 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $article->exists ? route('admin.news.update', $article) : route('admin.news.store') }}"
          enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-5">
        @csrf
        @if ($article->exists) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Slug (optional)</label>
                <input name="slug" value="{{ old('slug', $article->slug) }}" class="w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date', $article->date) }}" required class="w-full rounded border-gray-300">
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Category (EN)</label>
                <input name="category_en" value="{{ old('category_en', $article->category_en) }}" class="w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Category (AM)</label>
                <input name="category_am" value="{{ old('category_am', $article->category_am) }}" class="w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Category (AA)</label>
                <input name="category_aa" value="{{ old('category_aa', $article->category_aa) }}" class="w-full rounded border-gray-300">
            </div>
        </div>

        @foreach (['en' => 'English', 'am' => 'Amharic', 'aa' => 'Afar'] as $code => $label)
            <fieldset class="border rounded p-4 space-y-3">
                <legend class="text-sm font-semibold px-1">{{ $label }}</legend>
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input name="title_{{ $code }}" value="{{ old('title_'.$code, $article->{'title_'.$code}) }}"
                           @if($code === 'en') required @endif class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Excerpt</label>
                    <textarea name="excerpt_{{ $code }}" rows="2" class="w-full rounded border-gray-300">{{ old('excerpt_'.$code, $article->{'excerpt_'.$code}) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Body</label>
                    <textarea name="body_{{ $code }}" rows="6" class="w-full rounded border-gray-300">{{ old('body_'.$code, $article->{'body_'.$code}) }}</textarea>
                </div>
            </fieldset>
        @endforeach

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Image</label>
                @if ($article->image_url)
                    <img src="{{ $article->image_url }}" class="h-20 mb-2 rounded object-cover">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full">
                <input type="hidden" name="image_url" value="{{ $article->image_url }}">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Video URL</label>
                <input name="video_url" value="{{ old('video_url', $article->video_url) }}" class="w-full rounded border-gray-300">
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="published" value="1" @checked(old('published', $article->published))>
            Published
        </label>

        <div class="flex gap-3">
            <button type="submit" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-5 py-2 font-medium">Save</button>
            <a href="{{ route('admin.news.index') }}" class="px-5 py-2 text-gray-600">Cancel</a>
        </div>
    </form>
@endsection
