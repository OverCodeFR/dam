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
                <x-form.input-text name="unit" label="Unité" />
                <x-form.input-date name="start_at" label="Date de début" />
                <x-form.input-date name="end_at" label="Date de fin" />
                <x-form.type-list name="treatment_type_id" label="Type de traitement" :options="$treatmentTypes->pluck('name', 'id')" :value="old('treatment_type_id')" />
                <input type="hidden" name="patient_id" value="{{ request('patient_id') }}">
            </x-form.section>

            <x-form.section title="Fréquences" description="Quand le traitement doit être administré ?"><fieldset>
                    <div id="planned-field" class="mt-4">
                        <label class="block text-sm font-medium text-gray-700">Moments de la journée</label>
                        <div class="mt-2 space-y-2">

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="MATIN" value="MATIN" label="Matin" onchange="toggleTextbox('MATIN')" />
                                <x-form.input-hour id="preferredHour_MATIN" name="preferredHour_MATIN" label="Heure de préférence" :value="old('preferredHour_MATIN')"/>
                                <x-form.input-number-frequency id="amount_MATIN" name="amount_MATIN" min="0" label="Ajouter une quantité" :value="old('amount_MATIN')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="MIDI" value="MIDI" label="Midi" onchange="toggleTextbox('MIDI')" />
                                <x-form.input-hour id="preferredHour_MIDI" name="preferredHour_MIDI" label="Heure de préférence" :value="old('preferredHour_MIDI')"/>
                                <x-form.input-number-frequency id="amount_MIDI" name="amount_MIDI" min="0" label="Ajouter une quantité" :value="old('amount_MIDI')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="APRES_MIDI" value="APRES_MIDI" label="Après-midi" onchange="toggleTextbox('APRES_MIDI')" />
                                <x-form.input-hour id="preferredHour_APRES_MIDI" name="preferredHour_APRES_MIDI" label="Heure de préférence" :value="old('preferredHour_APRES_MIDI')"/>
                                <x-form.input-number-frequency id="amount_APRES_MIDI" name="amount_APRES_MIDI" min="0" label="Ajouter une quantité" :value="old('amount_APRES_MIDI')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="SOIR" value="SOIR" label="Soir" onchange="toggleTextbox('SOIR')" />
                                <x-form.input-hour id="preferredHour_SOIR" name="preferredHour_SOIR" label="Heure de préférence" :value="old('preferredHour_SOIR')"/>
                                <x-form.input-number-frequency id="amount_SOIR" name="amount_SOIR" min="0" label="Ajouter une quantité" :value="old('amount_SOIR')"/>
                            </div>

                            <div class="flex items-center gap-2">
                                <x-form.checkbox name="NUIT" value="NUIT" label="Nuit" onchange="toggleTextbox('NUIT')" />
                                <x-form.input-hour id="preferredHour_NUIT" name="preferredHour_NUIT" label="Heure de préférence" :value="old('preferredHour_NUIT')"/>
                                <x-form.input-number-frequency id="amount_NUIT" name="amount_NUIT" min="0" label="Ajouter une quantité" :value="old('amount_NUIT')"/>
                            </div>
                            <x-form.frequency-list name="frequency_id" label="" :options="$frequencies->pluck('name', 'id')" :value="old('frequency_id')" />
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
        function toggleTextbox(name) {
            const checkbox = document.getElementById(name);
            const inputBoxHourDiv = document.getElementById(`preferredHour_${name}`);
            const inputBoxQuantityDiv = document.getElementById(`amount_${name}`);
            inputBoxHourDiv.style.display = checkbox.checked ? 'block' : 'none';
            inputBoxQuantityDiv.style.display = checkbox.checked ? 'block' : 'none'; }

        toggleFields();
        document.addEventListener('DOMContentLoaded', () => {
            ['MATIN', 'MIDI', 'APRES_MIDI', 'SOIR', 'NUIT'].forEach(name => {
                toggleTextbox(name);
            });
        });

    </script>

</x-layouts.app>






