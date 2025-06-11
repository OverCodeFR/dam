<div class="flex items-center gap-x-3">
    <input
        id="{{ $id }}"
        name="{{ $name }}"
        type="radio"
        value="{{ $value }}"
        @if($checked) checked @endif
        @if($onchange) onchange="{{ $onchange }}" @endif
    />
    <label for="{{ $id }}" class="block text-sm/6 font-medium text-gray-900">{{ $label }}</label>
</div>
