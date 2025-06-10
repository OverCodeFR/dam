@php
    use Illuminate\Support\Str;
@endphp

<div class="sm:col-span-3 w-2/6">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-900">
        {{ $label }}
    </label>
    <div class="mt-2">
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes }}
            class="block w-full rounded-md bg-gray-300 py-1.5 pl-3 pr-8 text-base text-gray-900
                   outline outline-1 -outline-offset-1 outline-gray-300
                   focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600
                   sm:text-sm"
        >
            <option value="">-- Sélectionner --</option>
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" {{ old($name, $value ?? '') == $optionValue ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        </select>
    </div>
    @error($name)
    <p class="mt-1 text-sm text-red-600">
        Le champ {{ Str::lower($label ?? $name) }} est invalide.
    </p>
    @enderror
</div>
