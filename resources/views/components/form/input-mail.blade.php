@php
    use Illuminate\Support\Str;
@endphp
<div class="mb-4 w-full md:w-1/4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-300 mb-1">
        {{ $label }}
    </label>

    <input type="email"
           name="{{ $name }}"
           required
           value="{{ old($name) }}"
           class="block w-full rounded-md border @error($name) border-red-500 @else border-gray-300 @enderror bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-3 py-1" />

    @error($name)
    <p class="mt-1 text-sm text-red-600">
        Le champ {{ Str::lower($label ?? $name) }} est invalide.
    </p>
    @enderror
</div>
