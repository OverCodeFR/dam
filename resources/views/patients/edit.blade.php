<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Veuillez corriger les champs ci-dessous.
            </div>
        @endif
        <x-form.form-header
            title="Modifier un patient"
            description="Remplissez les champs suivants pour modifier les informations d'un patient."
        />

            <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="space-y-4">
            @method('PUT')
            @csrf

            <x-form.input-text name="name" id="name" :value="old('name', $patient->name)" label="Nom complet" />
            <x-form.input-tel name="phone" id="phone" :value="old('phone', $patient->phone)" label="Téléphone" />
            <x-form.input-text name="address" id="address" :value="old('address', $patient->address)" label="Adresse" />
            <x-form.input-mail name="email" id="email" :value="old('email', $patient->email)" label="Email" />


            <x-form.submit-button label="Valider les modifications" />
            <x-form.cancel-button/>

        </form>
    </div>
</x-layouts.app>

