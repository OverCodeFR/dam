@props([
    'title',
    'description',
    'routeSearch' => '#',
    'routeCreate' => null,
    'search' => null,
    'headers' => [],
    'pagination' => null
])

<div class="container mx-auto px-4 py-6">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold text-gray-100">{{ $title }}</h1>
                <p class="mt-2 text-sm text-gray-100">{{ $description }}</p>
            </div>
            @if($routeCreate)
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a href="{{ $routeCreate }}"
                       class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        Ajouter
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-8 flow-root">
            <form method="GET" action="{{ $routeSearch }}">
                <label for="search" class="block text-sm font-medium text-white">Recherche</label>
                <div class="mt-2 mb-4">
                    <div class="flex rounded-md bg-white outline outline-1 outline-gray-300 focus-within:outline-indigo-600">
                        <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Rechercher..."
                               class="block w-full px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm">
                        <div class="flex items-center px-2">
                            🔎
                        </div>
                    </div>
                </div>
            </form>

            <div class="overflow-hidden shadow ring-1 ring-black/5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-200">
                    <tr>
                        @foreach($headers as $header)
                            <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                {{ $header }}
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    {{ $slot }}
                    </tbody>
                </table>

                @if($pagination)
                    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                            <div class="text-sm text-gray-700">
                                Affichage de {{ $pagination->firstItem() }} à {{ $pagination->lastItem() }} sur {{ $pagination->total() }} résultats
                            </div>
                            <div>
                                {{ $pagination->links('pagination::tailwind') }}
                            </div>
                        </div>
                        <div class="flex flex-1 justify-between sm:hidden">
                            {{ $pagination->links('pagination::simple-tailwind') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
