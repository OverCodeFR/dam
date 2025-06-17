<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif

        <form action="{{ route('treatments_types.store') }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
            @csrf

            <x-form.section title="Informations du patient" description="Modifier les données du patient.">
                <x-form.input-text  name="name" id="name"  label="Type de traitement" />
                <x-form.type-list name="module" label="Module associé" :options="$modules" :value="old('module', $treatment->module ?? null)"/>
            </x-form.section>


            <x-form.button-group>
                <x-form.submit-button label="Ajouter le type" />
                <x-form.cancel-button label="Annuler"/>
            </x-form.button-group>


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

