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

            <x-form.section title="Fréquences" description="Quand le traitement doit être administré ?">
                <fieldset class="sm:col-span-6">
                    <legend class="text-sm font-semibold text-gray-900">Moments</legend>
                    <div class="mt-6 space-y-6">
                        <div class="flex gap-3">
                            <x-form.checkbox name="MATIN" label="Matin" />
                            <x-form.checkbox name="APRES_MIDI" label="Après-midi" />
                            <x-form.checkbox name="SOIR" label="Soir" />
                            <x-form.checkbox name="NUIT" label="Nuit" />
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

</x-layouts.app>
