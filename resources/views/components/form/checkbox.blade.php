@php
    use Illuminate\Support\Str;
@endphp

<div class="flex gap-3 items-center">
    <div class="group grid size-4 grid-cols-1">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            {{ old($name, $checked ?? false) ? 'checked' : '' }}
            class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-gray-300
                   checked:border-indigo-600 checked:bg-indigo-600
                   indeterminate:border-indigo-600 indeterminate:bg-indigo-600
                   focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600
                   disabled:border-gray-300 disabled:bg-gray-300 disabled:checked:bg-gray-300 forced-colors:appearance-auto"
        >
        <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
             viewBox="0 0 14 14" fill="none">
            <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"/>
            <path class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <label for="{{ $name }}" class="block text-sm text-gray-900 select-none">
        {{ $label }}
    </label>
</div>
