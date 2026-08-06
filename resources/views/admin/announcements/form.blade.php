@extends('admin.layout')

@section('title', $announcement->exists ? 'Edit Announcement' : 'New Announcement')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ $announcement->exists ? 'Edit Announcement' : 'New Announcement' }}</h1>

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
          action="{{ $announcement->exists ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}"
          enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 space-y-5">
        @csrf
        @if ($announcement->exists) @method('PUT') @endif

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Slug (optional)</label>
                <input name="slug" value="{{ old('slug', $announcement->slug) }}" class="w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date', $announcement->date) }}" required class="w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Type</label>
                <select name="type" required class="w-full rounded border-gray-300">
                    @foreach (['tender' => 'Tender', 'vacancy' => 'Vacancy', 'other' => 'Other'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('type', $announcement->type) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @foreach (['en' => 'English', 'am' => 'Amharic', 'aa' => 'Afar'] as $code => $label)
            <fieldset class="border rounded p-4 space-y-3">
                <legend class="text-sm font-semibold px-1">{{ $label }}</legend>
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input name="title_{{ $code }}" value="{{ old('title_'.$code, $announcement->{'title_'.$code}) }}"
                           @if($code === 'en') required @endif class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Body</label>
                    <textarea name="body_{{ $code }}" rows="6" class="w-full rounded border-gray-300">{{ old('body_'.$code, $announcement->{'body_'.$code}) }}</textarea>
                </div>
            </fieldset>
        @endforeach

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Image</label>
                @if ($announcement->image_url)
                    <img src="{{ $announcement->image_url }}" class="h-20 mb-2 rounded object-cover">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full">
                <input type="hidden" name="image_url" value="{{ $announcement->image_url }}">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Video URL</label>
                <input name="video_url" value="{{ old('video_url', $announcement->video_url) }}" class="w-full rounded border-gray-300">
            </div>
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="published" value="1" @checked(old('published', $announcement->published))>
            Published
        </label>

        <div class="flex gap-3">
            <button type="submit" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-5 py-2 font-medium">Save</button>
            <a href="{{ route('admin.announcements.index') }}" class="px-5 py-2 text-gray-600">Cancel</a>
        </div>
    </form>
@endsection
