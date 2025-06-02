<x-layouts.app>
    <form class="bg-gray-200 p-6 rounded-md shadow-sm" action="{{ route('patients.treatments.store') }}" method="POST">
        @csrf
        <div class="space-y-12">
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base/7 font-semibold text-gray-900">Traitement</h2>
{{--                    <p class="mt-1 text-sm/6 text-gray-600">Use a permanent address where you can receive mail.</p>--}}
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Nom</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" required autocomplete="name_treatment" class="block w-full rounded-md bg-gray-300 px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div><br>

                    <div class="sm:col-span-4">
                        <label for="dosage" class="block text-sm/6 font-medium text-gray-900">Dosage</label>
                        <div class="mt-2">
                            <input type="number" name="dosage" id="dosage" min="0" required autocomplete="dosage" class="block w-full rounded-md bg-gray-300 px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="col-span-4">
                        <label for="start_at" class="block text-sm/6 font-medium text-gray-900">Date de début</label>
                        <div class="mt-2">
                            <input type="date" name="start_at" id="start_at" required autocomplete="start_at" class="block w-full rounded-md bg-gray-300 px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="end_at" class="block text-sm/6 font-medium text-gray-900">Date de fin</label>
                        <div class="mt-2">
                            <input type="date" id="end_id" name="end_at" required autocomplete="end_at" class="block w-full rounded-md bg-gray-300 px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('patients.treatments', ['id' => $patient->id]) }}"
                               class="text-sm/6 font-semibold text-gray-900">
                                Cancel
                            </a>
                <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">Ajouter le traitement</button>
            </div>
        </div>
    </form>
</x-layouts.app>
