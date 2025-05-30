<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-white-800 mb-6">
        </h1>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold text-gray-100">Patients</h1>
                    <p class="mt-2 text-sm text-gray-100">Liste de tout les patients enregistrés</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a href="{{ route('patients.create') }}"
                       class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Ajouter un patient
                    </a>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black/5 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Nom</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Téléphone</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Adresse</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Modifier</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($patients as $patient)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$patient->name}}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$patient->phone}}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$patient->address}}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$patient->email}}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                                <div class="flex flex-1 justify-between sm:hidden">
                                    {{ $patients->links('pagination::simple-tailwind') }}
                                </div>
                                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                    <div class="text-sm text-gray-700">
                                        Affichage de {{ $patients->firstItem() }} à {{ $patients->lastItem() }} sur {{ $patients->total() }} résultats
                                    </div>
                                    <div>
                                        {{ $patients->links('pagination::tailwind') }}
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div></x-layouts.app>

