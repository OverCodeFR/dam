@props([
    'title' => '',
    'description' => ''
])

<div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold text-gray-900">{{ $title }}</h2>
        <p class="mt-1 text-sm text-gray-600">{{ $description }}</p>
    </div>

    <div class="flex flex-col gap-y-8 md:col-span-2">
    {{ $slot }}
    </div>
</div>
