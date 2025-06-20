<div class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
    <x-form.section title="Token du patient : {{ $patient->name }}">

        <div class="mb-4">
            @if ($patient->token)
                <label class="block text-sm font-medium text-gray-700 mb-1">Token généré :</label>
                <x-form.show-token name="token" id="token" value="{{ $token }}" label="Token" readonly/>
            @else
                <p class="text-gray-500 italic">Aucun token généré pour ce patient.</p>
            @endif
        </div>
    </x-form.section>

    <x-form.button-group>
        <div class="w-full flex justify-between items-center mt-6">
            <div class="self-start">
                <a href="{{ route('patients.index') }}" class="text-blue-600 hover:underline">
                    ← Retour à la liste des patients
                </a>
            </div>

            <div class="self-end">
                <button
                    wire:click="generateToken"
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm
                   hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2
                   focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Générer le token
                </button>
            </div>
        </div>

    </x-form.button-group>

</div>



