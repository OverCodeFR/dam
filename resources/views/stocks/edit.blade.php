<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif

        <form action="{{ route('stocks.update', $stock->id) }}"  method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
            @csrf
            @method('PUT')

            <x-form.section title="Informations du stock" description="Rentrer la nouvelle valeur du stock à enregistrer">
                <x-form.input-number  name="amount" id="amount" value="{{ old('amount', $stock->amount) }}" label="Valeur du stock du traitement" />
            </x-form.section>

            <x-form.button-group>
                <x-form.submit-button label="Actualiser le stock" />
                <x-form.cancel-button label="Annuler"/>
            </x-form.button-group>


        </form>
    </div>
</x-layouts.app>


