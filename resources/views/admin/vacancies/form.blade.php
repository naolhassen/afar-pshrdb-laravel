@extends('admin.layout')

@section('title', $vacancy->exists ? 'Edit Vacancy' : 'New Vacancy')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
        <div class="flex items-center gap-3">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-rose-100 text-rose-600">
                <i data-lucide="briefcase" class="h-5 w-5"></i>
            </span>
            <h1 class="text-2xl font-bold text-slate-900">{{ $vacancy->exists ? 'Edit Vacancy' : 'New Vacancy' }}</h1>
        </div>
        <a href="{{ route('admin.vacancies.index') }}" class="btn-ghost w-fit">
            <i data-lucide="arrow-left" class="h-4 w-4"></i> Back to Vacancies
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
          action="{{ $vacancy->exists ? route('admin.vacancies.update', $vacancy) : route('admin.vacancies.store') }}"
          enctype="multipart/form-data"
          class="admin-card p-6 sm:p-8 space-y-8 animate-scale-in" data-admin-form novalidate>
        @csrf
        @if ($vacancy->exists) @method('PUT') @endif

        <div class="grid gap-6 sm:grid-cols-3">
            @include('admin.partials.field', [
                'name' => 'slug',
                'label' => 'Slug (optional)',
                'icon' => 'link',
                'value' => $vacancy->slug,
                'placeholder' => 'auto-generated-if-empty',
                'help' => 'Leave empty to generate from the English title.',
            ])

            @include('admin.partials.field', [
                'name' => 'deadline',
                'label' => 'Deadline',
                'type' => 'date',
                'icon' => 'calendar-clock',
                'value' => $vacancy->deadline,
                'required' => true,
            ])

            @include('admin.partials.field', [
                'name' => 'image',
                'label' => $vacancy->exists ? 'Replace Image' : 'Image',
                'type' => 'file',
                'icon' => 'image',
                'accept' => '.jpg,.jpeg,.png,.webp',
                'help' => 'JPG, PNG, WebP. Max 5MB.',
            ])
        </div>

        @if ($vacancy->image_url)
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 animate-fade-in">
                <div class="flex items-center gap-4">
                    <span class="relative h-24 w-36 overflow-hidden rounded-xl bg-white shadow-sm">
                        <img src="{{ $vacancy->image_url }}" alt="Current image" class="h-full w-full object-cover">
                    </span>
                    <div>
                        <div class="text-sm font-semibold text-slate-700">Current image</div>
                        <a href="{{ $vacancy->image_url }}" target="_blank" rel="noreferrer" class="text-sm text-brand-600 hover:text-brand-800 transition">View image</a>
                    </div>
                </div>
            </div>
        @endif

        @foreach (['en' => 'English', 'am' => 'Amharic', 'aa' => 'Afar'] as $code => $label)
            <fieldset class="admin-card border-l-4 border-l-rose-500 p-6">
                <legend class="mb-4 flex items-center gap-2 text-sm font-bold uppercase tracking-wider text-slate-500">
                    <i data-lucide="languages" class="h-4 w-4 text-rose-500"></i>
                    {{ $label }}
                </legend>
                <div class="grid gap-6">
                    @include('admin.partials.field', [
                        'name' => 'title_'.$code,
                        'label' => 'Title',
                        'icon' => 'type',
                        'value' => $vacancy->{'title_'.$code},
                        'required' => $code === 'en',
                    ])

                    @include('admin.partials.field', [
                        'name' => 'description_'.$code,
                        'label' => 'Description',
                        'type' => 'textarea',
                        'icon' => 'align-left',
                        'value' => $vacancy->{'description_'.$code},
                        'rows' => 5,
                    ])

                    @include('admin.partials.field', [
                        'name' => 'requirements_'.$code,
                        'label' => 'Requirements',
                        'type' => 'textarea',
                        'icon' => 'list-checks',
                        'value' => $vacancy->{'requirements_'.$code},
                        'rows' => 5,
                    ])
                </div>
            </fieldset>
        @endforeach

        <div class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-100">
            <input type="checkbox" id="published" name="published" value="1" @checked(old('published', $vacancy->published)) class="form-checkbox">
            <label for="published" class="text-sm font-semibold text-slate-700 cursor-pointer">Publish this vacancy</label>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
            <button type="submit" class="btn-primary w-full sm:w-auto" data-loading-text="Saving vacancy…">
                <i data-lucide="save" class="h-4 w-4"></i>
                <span>Save Vacancy</span>
            </button>
            <a href="{{ route('admin.vacancies.index') }}" class="btn-ghost w-full sm:w-auto justify-center">
                Cancel
            </a>
        </div>
    </form>
@endsection
