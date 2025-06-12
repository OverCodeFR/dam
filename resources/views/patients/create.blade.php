<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif

        <form action="{{ route('patients.store') }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
            @csrf

            <x-form.section title="Informations du patient" description="Entrez les données du patient.">
                <x-form.input-text  name="name" id="name" required autocomplete="name_patient" label="Nom complet" />
                <x-form.input-tel   name="phone" id="phone" required autocomplete="tel" label="Téléphone" />
                <x-form.input-text  name="address" id="address" required autocomplete="address" label="Adresse" />
                <x-form.input-mail id="email" name="email" required autocomplete="email" label="Email" />
            </x-form.section>

            <x-form.button-group>
                <x-form.cancel-button label="Annuler"/>
                <x-form.submit-button label="Créer le patient" />
            </x-form.button-group>

        </form>
    </div>
</x-layouts.app>
