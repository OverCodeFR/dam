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
            <x-form.type-list name="treatment_type_id" label="Type de traitement" :options="$treatmentTypes->pluck('name', 'id')" :value="old('treatment_type_id')"/>





            //TODO component
            <div>
                <h2 class="text-base/7 font-semibold text-gray-900">Fréquences</h2>
            </div>
            <div class="max-w-2xl space-y-10 md:col-span-2">
                <fieldset>
                    <div class="mt-6 space-y-6">
                        <div class="flex gap-3">
                            <x-form.checkbox name="MATIN" label="Matin" />
                            <x-form.checkbox name="APRES_MIDI" label="Après-midi" />
                            <x-form.checkbox name="SOIR" label="Soir" />
                            <x-form.checkbox name="NUIT" label="Nuit" />
                        </div>
                    </div>
                </fieldset>
            </div>

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
