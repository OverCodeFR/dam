@php
    use Illuminate\Support\Str;
@endphp

<div class="sm:col-span-3 w-2/6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-900">
        {{ $label }}
    </label>
    <div class="mt-2">
        <input
            type="text"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            {{ $attributes }}
            class="block w-full rounded-md bg-gray-300 px-3 py-1.5 text-base text-gray-900
                   outline outline-1 -outline-offset-1 outline-gray-300
                   placeholder:text-gray-400
                   focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600
                   sm:text-sm"
        />
    </div>
    @error($name)
    <p class="mt-1 text-sm text-red-600">
        Le champ {{ Str::lower($label ?? $name) }} est invalide.
    </p>
    @enderror
</div>
