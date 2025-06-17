<x-layouts.app>
    <x-table.page-header
        title="Stocks"
        description="Liste de tous les stocks des traitements"
    />

    <x-table.search :action="route('stocks.index')"/>
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <x-table.table :headers="['Nom', 'Type', 'Quantité restante', 'Patient']">
                    @foreach($stocks as $stock)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $stock->treatment->name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $stock->treatment->treatment_type->name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $stock->amount }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $stock->treatment->patient->name }}</td>
                            <td>
                                <a href="{{ route('treatments.edit',$stock->treatment->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </x-table.table>

                <x-table.pagination :paginator="$stocks"/>
            </div>
        </div>
    </div>
</x-layouts.app>
