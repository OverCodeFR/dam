<x-layouts.app>
    <x-table.index
        title="Patients"
        description="Liste de tous les patients enregistrés"
        :routeSearch="route('patients.index')"
        :routeCreate="route('patients.create')"
        :search="request('search')"
        :pagination="$patients"
        :headers="['Nom', 'Téléphone', 'Adresse', 'Email', 'Actions']"
    >
        @foreach($patients as $patient)
            <tr>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->name }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->phone }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->address }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->email }}</td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                    <a href="{{ route('treatments.index', ['patient' => $patient->id]) }}"
                       class="text-indigo-600 hover:text-indigo-900">Traitements</a><br>
                    <a href="{{ route('patients.edit', $patient) }}"
                       class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                </td>
            </tr>
        @endforeach
    </x-table.index>
</x-layouts.app>
