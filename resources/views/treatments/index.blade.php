<x-layouts.app>
    <div class="container mx-auto px-4 py-6">

        <div class="sm:flex sm:items-center">
            <x-table.page-header
                title="Traitements"
                description="Liste de tous les traitements enregistrés"
            />
            @if (Request::is('treatments/*'))
                <x-table.add-button
                    text="Ajouter un traitement"
                    :url="route('treatments.create', ['patient_id' => $patient->id])"
                />
            @endif
            @if(auth()->user()->role === 'e5d2e8b5-7a40-3ed6-a7e9-00d3f87c385d')
                <x-table.add-button
                    text="Ajouter un traitement"
                    :url="route('treatments.create', ['patient_id' => \App\Models\Patient::where('user_id', auth()->id())->first()->id])"
                />
            @endif
        </div>

        <x-table.search :action="route('treatments.index')" />

        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <x-table.table :headers="['Nom', 'Dosage', 'Date de début', 'Date de fin', 'Patient']">
                        @foreach($treatments as $treatment)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$treatment->name}}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$treatment->dosage}}g</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $treatment->start_at ? $treatment->start_at->format('d/m/Y') : '—' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $treatment->end_at ? $treatment->end_at->format('d/m/Y') : '—' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $treatment->patient->name }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </x-table.table>

                    <x-table.pagination :paginator="$treatments" />
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
