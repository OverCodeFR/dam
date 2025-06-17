<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif

            <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
            @method('PUT')
            @csrf

                <x-form.section title="Informations du patient" description="Modifier les données du patient.">
                    <x-form.input-text name="name" id="name" :value="old('name', $patient->name)" label="Nom complet" />
                    <x-form.input-tel name="phone" id="phone" :value="old('phone', $patient->phone)" label="Téléphone" />
                    <x-form.input-text name="address" id="address" :value="old('address', $patient->address)" label="Adresse" />
                    <x-form.input-mail name="email" id="email" :value="old('email', $patient->email)" label="Email" />
                </x-form.section>

             <x-form.button-group>
                 <x-form.cancel-button label="Annuler"/>
                 <x-form.submit-button label="Valider les modifications" />
             </x-form.button-group>

        </form>
    </div>
</x-layouts.app>

