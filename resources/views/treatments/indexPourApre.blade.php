<x-layouts.app>
    <x-table.index
        title="Traitements"
        description="Liste de tous les traitements enregistrés"
        routeSearch="{{ route('treatments.index') }}"
        :headers="['Nom', 'Dosage', 'Date de début', 'Date de fin', 'Modifier']"
        :search="request('search')"
        :pagination="$treatments"
    >
        @foreach($treatments as $treatment)
            <tr>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $treatment->name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $treatment->dosage }}g</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ optional($treatment->start_at)->format('d/m/Y') }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ optional($treatment->end_at)->format('d/m/Y') }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-indigo-600">
                    <a href="#" class="hover:text-indigo-900">Modifier</a>
                </td>
            </tr>
        @endforeach
    </x-table.index>
</x-layouts.app>

