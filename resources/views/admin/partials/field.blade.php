@props([
    'name' => '',
    'label' => '',
    'type' => 'text',
    'icon' => null,
    'value' => null,
    'required' => false,
    'help' => null,
    'placeholder' => '',
    'options' => [],
    'rows' => 5,
    'accept' => null,
])

@php
    $hasError = $errors->has($name);
    $hasSuccess = !$hasError && old($name) !== null && old($name) !== '';
    $baseClass = $hasError ? 'input-invalid' : ($hasSuccess ? 'input-valid' : '');
@endphp

<div class="form-group" data-field-group="{{ $name }}">
    <label for="{{ $name }}" class="form-label">
        @if ($icon)
            <i data-lucide="{{ $icon }}" class="h-4 w-4 text-slate-400"></i>
        @endif
        {{ $label }}
        @if ($required)
            <span class="text-rose-500">*</span>
        @endif
    </label>

    @if (in_array($type, ['text', 'email', 'date', 'url', 'number', 'password']))
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            value="{{ old($name, $value) }}"
            @if ($required) required @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            class="form-input {{ $icon ? 'form-input-icon' : '' }} {{ $baseClass }}"
        >
        @if ($icon)
            <i data-lucide="{{ $icon }}" class="form-icon"></i>
        @endif
    @elseif ($type === 'textarea')
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            @if ($required) required @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            class="form-textarea {{ $baseClass }}"
        >{{ old($name, $value) }}</textarea>
    @elseif ($type === 'select')
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            @if ($required) required @endif
            class="form-select {{ $baseClass }}"
        >
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
    @elseif ($type === 'file')
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="file"
            @if ($accept) accept="{{ $accept }}" @endif
            class="form-input {{ $baseClass }}"
        >
    @endif

    @if ($help)
        <p class="form-help">{{ $help }}</p>
    @endif

    @error($name)
        <p class="form-error animate-shake"><i data-lucide="x-circle" class="h-3.5 w-3.5"></i> {{ $message }}</p>
    @enderror

    @if ($hasSuccess)
        <p class="form-success"><i data-lucide="check-circle-2" class="h-3.5 w-3.5"></i> Looks good</p>
    @endif
</div>
