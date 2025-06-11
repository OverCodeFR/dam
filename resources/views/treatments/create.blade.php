<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif

        <form action="{{ route('treatments.store') }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
            @csrf

            <x-form.section title="Informations du traitement" description="Entrez les données du traitement.">
                <x-form.input-text name="name" label="Nom" />
                <x-form.input-number name="dosage" label="Dosage" />
                <x-form.input-date name="start_at" label="Date de début" />
                <x-form.input-date name="end_at" label="Date de fin" />
                <x-form.type-list name="treatment_type_id" label="Type de traitement" :options="$treatmentTypes->pluck('name', 'id')" :value="old('treatment_type_id')" />
                <input type="hidden" name="patient_id" value="{{ request('patient_id') }}">
            </x-form.section>

            <x-form.section title="Fréquences" description="Quand le traitement doit être administré ?"><fieldset>
                    <legend class="text-sm/6 font-semibold text-gray-900">Fréquences</legend>

                    <div class="mt-6 space-y-6">
                        <x-form.radio id="periodic" name="frequency" value="periodic" label="Périodique" checked="true" onchange="toggleFields()"/>
                        <x-form.radio id="planned" name="frequency" value="planned" label="Planifier" onchange="toggleFields()"/>
                    </div>

                    <x-form.input-hour-interval id="periodic-field" name="interval" min="1" max="24" label="À quel intervalle d'heures est-ce que cela se produit ?" placeholder="Ex: 1"/>

                    <div id="planned-field" class="mt-4 hidden">
                        <label class="block text-sm font-medium text-gray-700">Moments de la journée</label>
                        <div class="mt-2 space-y-2">

                            <div class="flex items-center gap-2">
                                <x-form.checkbox id="MATIN" name="MATIN" label="Matin" onchange="toggleTextbox('MATIN')" />
                                <x-form.moment-day-list id="listbox_MATIN" name="listbox_MATIN" :options="$frequency_getMatin->pluck('hour', 'id')" :value="old('listbox_MATIN')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="MIDI" label="Midi" onchange="toggleTextbox('MIDI')" />
                                <x-form.moment-day-list id="listbox_MIDI" name="listbox_MIDI" :options="$frequency_getMidi->pluck('hour', 'id')" :value="old('list_MIDI')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="APRES_MIDI" label="Après-midi" onchange="toggleTextbox('APRES_MIDI')" />
                                <x-form.moment-day-list id="listbox_APRES_MIDI" name="listbox_APRES_MIDI" :options="$frequency_getApres_midi->pluck('hour', 'id')" :value="old('list_APRES_MIDI')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="SOIR" label="Soir" onchange="toggleTextbox('SOIR')" />
                                <x-form.moment-day-list id="listbox_SOIR" name="listbox_SOIR" :options="$frequency_getSoir->pluck('hour', 'id')" :value="old('list_SOIR')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="NUIT" label="Nuit" onchange="toggleTextbox('NUIT')" />
                                <x-form.moment-day-list id="listbox_NUIT" name="listbox_NUIT" :options="$frequency_getNuit->pluck('hour', 'id')" :value="old('list_NUIT')"/>
                            </div>

                        </div>
                    </div>
                </fieldset>
            </x-form.section>


            <x-form.button-group>
                <x-form.cancel-button label="Annuler"/>
                <x-form.submit-button label="Créer le traitement" />
            </x-form.button-group>

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
    <script>
        function toggleFields() {
            const isPeriodic = document.getElementById('periodic').checked;
            document.getElementById('periodic-field').style.display = isPeriodic ? 'block' : 'none';
            document.getElementById('planned-field').style.display = isPeriodic ? 'none' : 'block';
        }

        function toggleTextbox(name) {
            const checkbox = document.getElementById(name);
            const listboxDiv = document.getElementById(`listbox_${name}`);
            listboxDiv.style.display = checkbox.checked ? 'block' : 'none'; }

        toggleFields();
        document.addEventListener('DOMContentLoaded', () => {
            ['MATIN', 'MIDI', 'APRES_MIDI', 'SOIR', 'NUIT'].forEach(name => {
                toggleTextbox(name);
            });
        });

    </script>

</x-layouts.app>






