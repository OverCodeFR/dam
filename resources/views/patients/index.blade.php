<x-layouts.app>
    <x-table.index
        title="Patients"
        description="Liste de tous les patients enregistrés"
        routeSearch="{{ route('patients.index') }}"
        routeCreate="{{ route('patients.create') }}"
        search="{{ request('search') }}"
        :headers="['Nom', 'Téléphone', 'Adresse', 'Email', 'Modifier']"
        :pagination="$patients"
    >
        @foreach($patients as $patient)
            <tr>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $patient->name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->phone }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->address }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->email }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-indigo-600">
                    <a href="#" class="hover:text-indigo-900">Modifier</a>
                </td>
            </tr>
        @endforeach
    </x-table.index>
</x-layouts.app>
