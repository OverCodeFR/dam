@php
    use Illuminate\Support\Str;
@endphp

<div class="mb-4 w-full md:w-1/4" id="{{$id}}">
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        style="display: none;"
        {{ $attributes->merge([
            'class' => 'block w-full rounded-md border ' . ($errors->has($name) ? 'border-red-500' : 'border-gray-300') . ' bg-white text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm px-3 py-1'
        ]) }}
    >
        <option value="">-- Sélectionner un type --</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @error($name)
    <p class="mt-1 text-sm text-red-600">
        Le champ {{ Str::lower($name) }} est invalide.
    </p>
    @enderror
</div>
