{{$errors}}

<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif
        <x-form.form-header
            title="Créer un traitement"
            description="Remplissez les champs suivants pour enregistrer un nouveau traitement."
        />

        <form action="{{ route('treatments.store') }}" method="POST" class="space-y-4">
            @csrf

            <x-form.input-text  name="name" id="name"  label="Nom" />
            <x-form.input-number   name="dosage" id="dosage" min="0"  label="Dosage" />
            <x-form.input-date name="start_at" id="start_at" label="Date de début" />
            <x-form.input-date  name="end_at" id="end_at" label="Date de fin" />
            <input type="hidden" name="patient_id" value="{{ request('patient_id') }}">


            //TODO component
            <div>
                <h2 class="text-base/7 font-semibold text-gray-900">Fréquences</h2>
{{--                <p class="mt-1 text-sm/6 text-gray-600">
                        We'll always let you know about important changes, but you pick what else you want to hear about.</p>--}}
            </div>

            <div class="max-w-2xl space-y-10 md:col-span-2">
                <fieldset>
                    <div class="mt-6 space-y-6">
                        <div class="flex gap-3">


                            //Bouton matin
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input aria-describedby="comments-description" name="MATIN"
                                        type="checkbox" class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-gray-300 checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-300 disabled:checked:bg-gray-300 forced-colors:appearance-auto">
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                        viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <div class="text-sm/6">
                                <label for="MATIN" class="font-medium text-gray-900">Matin</label>
{{--                                <p id="comments-description" class="text-gray-500">
                                        Get notified when someone posts a comment on a posting.</p>--}}
                            </div>


                            //Bouton midi
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input aria-describedby="comments-description" name="MIDI"
                                           type="checkbox" class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-gray-300 checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-300 disabled:checked:bg-gray-300 forced-colors:appearance-auto">
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                         viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="MIDI" class="font-medium text-gray-900">Midi</label>
                                {{--                                <p id="comments-description" class="text-gray-500">
                                                                        Get notified when someone posts a comment on a posting.</p>--}}
                            </div>


                            //Bouton après-midi
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input aria-describedby="comments-description" name="APRES_MIDI"
                                           type="checkbox" class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-gray-300 checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-300 disabled:checked:bg-gray-300 forced-colors:appearance-auto">
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                         viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="APRES_MIDI" class="font-medium text-gray-900">Après-midi</label>
                                {{--                                <p id="comments-description" class="text-gray-500">
                                                                        Get notified when someone posts a comment on a posting.</p>--}}
                            </div>


                            //Bouton soir
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input aria-describedby="comments-description" name="SOIR"
                                           type="checkbox" class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-gray-300 checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-300 disabled:checked:bg-gray-300 forced-colors:appearance-auto">
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                         viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="SOIR" class="font-medium text-gray-900">Soir</label>
                                {{--                                <p id="comments-description" class="text-gray-500">
                                                                        Get notified when someone posts a comment on a posting.</p>--}}
                            </div>


                            //Bouton nuit
                            <div class="flex h-6 shrink-0 items-center">
                                <div class="group grid size-4 grid-cols-1">
                                    <input aria-describedby="comments-description" name="NUIT"
                                           type="checkbox" class="col-start-1 row-start-1 appearance-none rounded border border-gray-300 bg-gray-300 checked:border-indigo-600 checked:bg-indigo-600 indeterminate:border-indigo-600 indeterminate:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-300 disabled:checked:bg-gray-300 forced-colors:appearance-auto">
                                    <svg class="pointer-events-none col-start-1 row-start-1 size-3.5 self-center justify-self-center stroke-white group-has-[:disabled]:stroke-gray-950/25"
                                         viewBox="0 0 14 14" fill="none">
                                        <path class="opacity-0 group-has-[:checked]:opacity-100" d="M3 8L6 11L11 3.5" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round"/>
                                        <path
                                            class="opacity-0 group-has-[:indeterminate]:opacity-100" d="M3 7H11" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm/6">
                                <label for="NUIT" class="font-medium text-gray-900">Nuit</label>
                                {{--                                <p id="comments-description" class="text-gray-500">
                                                                        Get notified when someone posts a comment on a posting.</p>--}}
                            </div>



                        </div>
                    </div>
                </fieldset>
            </div>
            //TODO fin component



            <x-form.submit-button label="Créer le traitement" />
            <x-form.cancel-button/>

        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const startAt = document.getElementById('start_at');
            const endAt = document.getElementById('end_at');

            if (startAt && endAt) {
                startAt.addEventListener('change', () => {
                    endAt.min = startAt.value;
                    if (endAt.value && endAt.value < startAt.value) {
                        endAt.value = startAt.value;
                    }
                });
            }
        });
    </script>

</x-layouts.app>
