<div class="overflow-hidden shadow ring-1 ring-black/5 sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-300">
        <thead class="bg-gray-200">
        <tr>
            @foreach ($headers as $header)
                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ $header }}</th>
            @endforeach
            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
        {{ $slot }}
        </tbody>
    </table>
</div>
