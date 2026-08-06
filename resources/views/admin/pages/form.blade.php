@extends('admin.layout')

@section('title', $page->exists ? 'Edit Page' : 'New Page')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ $page->exists ? 'Edit Page' : 'New Page' }}</h1>

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
          action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}"
          enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-5">
        @csrf
        @if ($page->exists) @method('PUT') @endif

        <div>
            <label class="block text-sm font-medium mb-1">Slug (optional)</label>
            <input name="slug" value="{{ old('slug', $page->slug) }}" class="w-full rounded border-gray-300">
        </div>

        @foreach (['en' => 'English', 'am' => 'Amharic', 'aa' => 'Afar'] as $code => $label)
            <fieldset class="border rounded p-4 space-y-3">
                <legend class="text-sm font-semibold px-1">{{ $label }}</legend>
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input name="title_{{ $code }}" value="{{ old('title_'.$code, $page->{'title_'.$code}) }}"
                           @if($code === 'en') required @endif class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Content</label>
                    <textarea name="content_{{ $code }}" rows="8" class="w-full rounded border-gray-300">{{ old('content_'.$code, $page->{'content_'.$code}) }}</textarea>
                </div>
            </fieldset>
        @endforeach

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Image</label>
                @if ($page->image_url)
                    <img src="{{ $page->image_url }}" class="h-20 mb-2 rounded object-cover">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full">
                <input type="hidden" name="image_url" value="{{ $page->image_url }}">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Video URL</label>
                <input name="video_url" value="{{ old('video_url', $page->video_url) }}" class="w-full rounded border-gray-300">
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="published" value="1" @checked(old('published', $page->published))>
            Published
        </label>

        <div class="flex gap-3">
            <button type="submit" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-5 py-2 font-medium">Save</button>
            <a href="{{ route('admin.pages.index') }}" class="px-5 py-2 text-gray-600">Cancel</a>
        </div>
    </form>
@endsection
