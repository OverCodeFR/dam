<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif
        <x-form.form-header
            title="Modifier un traitement"
            description="Remplissez les champs suivants pour modifier les informations d'un traitement."
        />

        <form action="{{ route('treatments.update', $treatment->id) }}" method="POST" class="space-y-4">
            @method('PUT')
            @csrf

            <x-form.input-text name="name" :value="old('name', $treatment->name)" label="Nom" />
            <x-form.input-number name="dosage" :value="old('dosage', $treatment->dosage)" label="Dosage" />
            <x-form.input-date name="start_at" :value="old('start_at', $treatment->start_at->format('Y-m-d'))" label="Date de début" />
            <x-form.input-date name="end_at" :value="old('end_at', $treatment->end_at->format('Y-m-d'))" label="Date de fin" />
            <x-form.type-list name="treatment_type_id" label="Type de traitement" :options="$treatmentTypes->pluck('name', 'id')" :value="old('treatment_type_id', $treatment->treatment_type_id)"/>





            <x-form.submit-button label="Valider les modifications" />
            <x-form.cancel-button/>
        </form>
    </div>
</x-layouts.app>


