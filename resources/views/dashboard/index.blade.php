
<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-table.page-header
                title="Stocks"
                description="Liste de tous les stocks des traitements"
            />

        <x-table.search :action="route('dashboard.index')"/>
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
    </div>
    </div>
</x-layouts.app>
