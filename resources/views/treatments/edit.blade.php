<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif

        <form action="{{ route('treatments.update', $treatment->id) }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
            @method('PUT')
            @csrf

            <x-form.section title="Informations du traitement" description="Modifier les données du traitement.">
                <x-form.input-text name="name" id="name" :value="old('name', $treatment->name)" label="Nom" />
                <x-form.input-number name="dosage" id="dosage" :value="old('dosage', $treatment->dosage)" label="Dosage" />
                <x-form.input-date name="start_at" id="start_at" :value="old('start_at', $treatment->start_at->format('Y-m-d'))" label="Date de début" />
                <x-form.input-date name="end_at" id="end_at" :value="old('end_at', $treatment->end_at->format('Y-m-d'))" label="Date de fin" />
                <x-form.type-list name="treatment_type_id" label="Type de traitement" :options="$treatmentTypes->pluck('name', 'id')" :value="old('treatment_type_id', $treatment->treatment_type_id)"/>
            </x-form.section>



            <x-form.button-group>
                <x-form.cancel-button label="Annuler"/>
                <x-form.submit-button label="Valider les modifications" />
            </x-form.button-group>
        </form>
    </div>
</x-layouts.app>


