<x-layouts.app>
    <x-table.index
        title="Traitements"
        description="Liste de tous les traitements enregistrés"
        :routeSearch="route('treatments.index')"
        :routeCreate="route('treatments.create')"
        :search="request('search')"
        :pagination="$treatments"
        :headers="['Nom', 'Dosage', 'Date de début', 'Date de fin', 'Patient', 'Modifier']"
    >
        @foreach($treatments as $treatment)
            <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                    {{ $treatment->name }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ $treatment->dosage }}g
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ $treatment->start_at ? $treatment->start_at->format('d/m/Y') : '—' }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ $treatment->end_at ? $treatment->end_at->format('d/m/Y') : '—' }}
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ $treatment->patient->name }}
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                    <a href="{{ route('treatments.edit', $treatment) }}" class="text-indigo-600 hover:text-indigo-900">
                        Modifier
                    </a>
                </td>
            </tr>
        @endforeach
    </x-table.index>
</x-layouts.app>
