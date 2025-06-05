<x-layouts.app>
    <div class="container mx-auto px-4 py-6">

        <div class="sm:flex sm:items-center">
            <x-table.page-header
                title="Patients"
                description="Liste de tous les patients enregistrés"
            />
            <x-table.add-button
                text="Ajouter un patient"
                :url="route('patients.create')"
            />
        </div>

        <x-table.search :action="route('patients.index')" />

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <x-table.table :headers="['Nom', 'Téléphone', 'Adresse', 'Email']">
                        @foreach($patients as $patient)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->phone }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->address }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $patient->email }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                    <a href="{{ route('treatments.index', ['patient' => $patient->id]) }}" class="text-indigo-600 hover:text-indigo-900">Traitements</a><br>
                                    @cannot('update', App\Models\Patient::class)
                                    <a href="{{ route('patients.edit',$patient->id) }}" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </x-table.table>

                    <x-table.pagination :paginator="$patients" />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
