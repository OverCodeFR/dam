<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Veuillez corriger les champs ci-dessous.
            </div>
        @endif
        <x-form.form-header
            title="Modifier un traitement"
            description="Remplissez les champs suivants pour modifier les informations d'un traitement."
        />

        <form action="{{ route('treatments.update', $treatment->id) }}" method="POST" class="space-y-4">
            @method('PUT')
            @csrf

            <x-form.input-text name="name" id="name" :value="old('name', $treatment->name)" label="Nom" />
            <x-form.input-number name="dosage" id="dosage" :value="old('dosage', $treatment->dosage)" label="Dosage" />
            <x-form.input-date name="start_at" id="start_at" :value="old('start_at', $treatment->start_at->format('Y-m-d'))" label="Date de début" />
            <x-form.input-date name="end_at" id="end_at" :value="old('end_at', $treatment->end_at->format('Y-m-d'))" label="Date de fin" />


            <x-form.submit-button label="Valider les modifications" />
            <x-form.cancel-button/>
        </form>
    </div>
</x-layouts.app>


