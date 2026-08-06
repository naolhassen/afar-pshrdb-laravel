@extends('admin.layout')

@section('title', $vacancy->exists ? 'Edit Vacancy' : 'New Vacancy')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ $vacancy->exists ? 'Edit Vacancy' : 'New Vacancy' }}</h1>

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
          action="{{ $vacancy->exists ? route('admin.vacancies.update', $vacancy) : route('admin.vacancies.store') }}"
          class="bg-white rounded-lg shadow p-6 space-y-5">
        @csrf
        @if ($vacancy->exists) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Slug (optional)</label>
                <input name="slug" value="{{ old('slug', $vacancy->slug) }}" class="w-full rounded border-gray-300">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline', $vacancy->deadline) }}" required class="w-full rounded border-gray-300">
            </div>
        </div>

        @foreach (['en' => 'English', 'am' => 'Amharic', 'aa' => 'Afar'] as $code => $label)
            <fieldset class="border rounded p-4 space-y-3">
                <legend class="text-sm font-semibold px-1">{{ $label }}</legend>
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input name="title_{{ $code }}" value="{{ old('title_'.$code, $vacancy->{'title_'.$code}) }}"
                           @if($code === 'en') required @endif class="w-full rounded border-gray-300">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description_{{ $code }}" rows="5" class="w-full rounded border-gray-300">{{ old('description_'.$code, $vacancy->{'description_'.$code}) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Requirements</label>
                    <textarea name="requirements_{{ $code }}" rows="5" class="w-full rounded border-gray-300">{{ old('requirements_'.$code, $vacancy->{'requirements_'.$code}) }}</textarea>
                </div>
            </fieldset>
        @endforeach

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="published" value="1" @checked(old('published', $vacancy->published))>
            Published
        </label>

        <div class="flex gap-3">
            <button type="submit" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-5 py-2 font-medium">Save</button>
            <a href="{{ route('admin.vacancies.index') }}" class="px-5 py-2 text-gray-600">Cancel</a>
        </div>
    </form>
@endsection
