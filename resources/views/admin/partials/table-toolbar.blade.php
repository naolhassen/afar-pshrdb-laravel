@php
    $search = $filters['search'] ?? '';
    $category = $filters['category'] ?? '';
    $status = $filters['status'] ?? '';
    $categoryOptions = $categoryOptions ?? collect();
@endphp

<form method="GET" class="mb-5 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between animate-fade-in">
    <div class="relative flex-1 max-w-md">
        <i data-lucide="search" class="absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
        <input type="text" name="search" value="{{ $search }}" placeholder="Search..." class="form-input form-input-icon w-full pl-10 text-sm">
    </div>

    <div class="flex flex-wrap items-center gap-3">
        @if ($categoryOptions->isNotEmpty())
            <select name="category" class="form-select min-w-[10rem] text-sm" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach ($categoryOptions as $cat)
                    <option value="{{ $cat }}" @selected($category === $cat)>{{ $cat }}</option>
                @endforeach
            </select>
        @endif

        <select name="status" class="form-select min-w-[10rem] text-sm" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            <option value="published" @selected($status === 'published')>Published</option>
            <option value="draft" @selected($status === 'draft')>Draft</option>
        </select>

        <button type="submit" class="btn-primary">
            <i data-lucide="search" class="h-4 w-4"></i>
            Filter
        </button>

        @if ($search || $category || $status)
            <a href="{{ request()->url() }}" class="btn-ghost">
                <i data-lucide="x" class="h-4 w-4"></i>
                Clear
            </a>
        @endif
    </div>
</form>
