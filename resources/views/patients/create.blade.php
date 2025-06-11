<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif
        <x-form.form-header
            title="Créer un patient"
            description="Remplissez les champs suivants pour enregistrer un nouveau patient."
        />

        <form action="{{ route('patients.store') }}" method="POST" class="space-y-4">
            @csrf

            <x-form.input-text  name="name" required autocomplete="name_patient" label="Nom complet" />
            <x-form.input-tel   name="phone" required autocomplete="tel" label="Téléphone" />
            <x-form.input-text  name="address" required autocomplete="address" label="Adresse" />
            <x-form.input-mail id="email" required autocomplete="email" label="Email" />


            <x-form.submit-button label="Créer le patient" />
            <x-form.cancel-button/>

        </form>
    </div>
</x-layouts.app>
