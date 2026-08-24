@extends('admin.layout')

@section('title', $article->exists ? 'Edit Article' : 'New Article')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                <i data-lucide="newspaper" class="h-5 w-5"></i>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">{{ $article->exists ? 'Edit Article' : 'New Article' }}</h1>
        </div>
        <a href="{{ route('admin.news.index') }}" class="btn-ghost w-fit">
            <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to Articles
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 flex items-start gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm font-semibold text-rose-700 animate-shake">
            <i data-lucide="alert-circle" class="mt-0.5 h-4 w-4"></i>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $article->exists ? route('admin.news.update', $article) : route('admin.news.store') }}"
          enctype="multipart/form-data" class="admin-card p-6 sm:p-8 space-y-8 animate-scale-in" data-admin-form novalidate>
        @csrf
        @if ($article->exists) @method('PUT') @endif

        <div class="grid gap-6 sm:grid-cols-2">
            @include('admin.partials.field', [
                'name' => 'slug',
                'label' => 'Slug (optional)',
                'icon' => 'link',
                'value' => $article->slug,
                'placeholder' => 'auto-generated-if-empty',
                'help' => 'Leave empty to generate from the English title.',
            ])

            @include('admin.partials.field', [
                'name' => 'date',
                'label' => 'Date',
                'type' => 'date',
                'icon' => 'calendar',
                'value' => $article->date,
                'required' => true,
            ])
        </div>

        <div class="grid gap-6 sm:grid-cols-3">
            @include('admin.partials.field', [
                'name' => 'category_en',
                'label' => 'Category (EN)',
                'icon' => 'tag',
                'value' => $article->category_en,
            ])
            @include('admin.partials.field', [
                'name' => 'category_am',
                'label' => 'Category (AM)',
                'icon' => 'tag',
                'value' => $article->category_am,
            ])
            @include('admin.partials.field', [
                'name' => 'category_aa',
                'label' => 'Category (AA)',
                'icon' => 'tag',
                'value' => $article->category_aa,
            ])
        </div>

        @foreach (['en' => 'English', 'am' => 'Amharic', 'aa' => 'Afar'] as $code => $label)
            <fieldset class="admin-card border-l-4 border-l-brand-500 p-6">
                <legend class="mb-4 flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-slate-500">
                    <i data-lucide="languages" class="h-4 w-4 text-brand-500"></i>
                    {{ $label }}
                </legend>
                <div class="grid gap-6">
                    @include('admin.partials.field', [
                        'name' => 'title_'.$code,
                        'label' => 'Title',
                        'icon' => 'type',
                        'value' => $article->{'title_'.$code},
                        'required' => $code === 'en',
                    ])

                    @include('admin.partials.field', [
                        'name' => 'excerpt_'.$code,
                        'label' => 'Excerpt',
                        'type' => 'textarea',
                        'icon' => 'align-left',
                        'value' => $article->{'excerpt_'.$code},
                        'rows' => 3,
                    ])

                    @include('admin.partials.field', [
                        'name' => 'body_'.$code,
                        'label' => 'Body',
                        'type' => 'textarea',
                        'icon' => 'file-text',
                        'value' => $article->{'body_'.$code},
                        'rows' => 6,
                    ])
                </div>
            </fieldset>
        @endforeach

        <div class="grid gap-6 sm:grid-cols-2">
            <div class="space-y-3">
                @include('admin.partials.field', [
                    'name' => 'image',
                    'label' => 'Featured Image',
                    'type' => 'file',
                    'icon' => 'image',
                    'accept' => 'image/*',
                    'help' => 'Accepted formats: JPG, PNG, WEBP.',
                ])
                @if ($article->image_url)
                    <div class="overflow-hidden rounded-2xl border border-slate-200 w-fit animate-fade-in">
                        <img src="{{ $article->image_url }}" class="h-28 w-auto object-cover" alt="Current image">
                    </div>
                @endif
                <input type="hidden" name="image_url" value="{{ $article->image_url }}">
            </div>

            @include('admin.partials.field', [
                'name' => 'video_url',
                'label' => 'Video URL',
                'icon' => 'video',
                'value' => $article->video_url,
                'help' => 'Optional link to an external video.',
            ])
        </div>

        <div class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-100">
            <input type="checkbox" id="published" name="published" value="1" @checked(old('published', $article->published)) class="form-checkbox">
            <label for="published" class="text-sm font-semibold text-slate-700 cursor-pointer">Publish this article</label>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
            <button type="submit" class="btn-primary w-full sm:w-auto" data-loading-text="Saving article…">
                <i data-lucide="save" class="h-4 w-4"></i>
                <span>Save Article</span>
            </button>
            <a href="{{ route('admin.news.index') }}" class="btn-ghost w-full sm:w-auto justify-center">
                Cancel
            </a>
        </div>
    </form>
@endsection
