<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Veuillez corriger les champs ci-dessous.
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


            <x-form.submit-button label="Créer le traitement" />
            <x-form.cancel-button href="{{ url()->previous() }}" />

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
