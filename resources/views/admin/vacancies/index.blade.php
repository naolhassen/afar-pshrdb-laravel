@extends('admin.layout')

@section('title', 'Vacancies')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Vacancies</h1>
        <a href="{{ route('admin.vacancies.create') }}" class="bg-brand-700 hover:bg-brand-800 text-white rounded px-4 py-2 text-sm font-medium">
            New Vacancy
        </a>
    </div>

    <div class="bg-white rounded-lg shadow divide-y">
        @forelse ($vacancies as $vacancy)
            <div class="flex items-center justify-between p-4">
                <div>
                    <div class="font-medium">{{ $vacancy->title_en }}</div>
                    <div class="text-xs text-gray-500">
                        Deadline: {{ $vacancy->deadline }} &middot; {{ $vacancy->published ? 'Published' : 'Draft' }}
                    </div>
                </div>
                <div class="flex gap-3 text-sm">
                    <a href="{{ route('admin.vacancies.edit', $vacancy) }}" class="text-brand-700 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.vacancies.destroy', $vacancy) }}"
                          onsubmit="return confirm('Delete this vacancy?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-gray-500">No vacancies yet.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $vacancies->links() }}</div>
@endsection
