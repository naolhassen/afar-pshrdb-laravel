@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.news.index') }}" class="bg-white rounded-lg shadow p-5">
            <div class="text-3xl font-bold text-brand-800">{{ $counts['news'] }}</div>
            <div class="text-sm text-gray-500">News Articles</div>
        </a>
        <a href="{{ route('admin.pages.index') }}" class="bg-white rounded-lg shadow p-5">
            <div class="text-3xl font-bold text-brand-800">{{ $counts['pages'] }}</div>
            <div class="text-sm text-gray-500">Pages</div>
        </a>
        <a href="{{ route('admin.announcements.index') }}" class="bg-white rounded-lg shadow p-5">
            <div class="text-3xl font-bold text-brand-800">{{ $counts['announcements'] }}</div>
            <div class="text-sm text-gray-500">Announcements</div>
        </a>
        <a href="{{ route('admin.vacancies.index') }}" class="bg-white rounded-lg shadow p-5">
            <div class="text-3xl font-bold text-brand-800">{{ $counts['vacancies'] }}</div>
            <div class="text-sm text-gray-500">Vacancies</div>
        </a>
    </div>
@endsection
