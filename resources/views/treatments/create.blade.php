<x-layouts.app>
    <div class="container mx-auto px-6 py-8">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Assurez-vous de remplir correctement les champs ci-dessous.
            </div>
        @endif

        <form action="{{ route('treatments.store') }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-6">
            @csrf

            <!-- En-tête du formulaire -->
            <header class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700">Créer un traitement</h2>
                <p class="mt-1 text-sm text-gray-600">Remplissez les champs suivants pour enregistrer un nouveau traitement.</p>
            </header>

            <!-- Section informations du traitement -->
            <div class="space-y-4 border-b border-gray-300 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-1">
                        <h3 class="text-base font-semibold text-gray-900">Traitement</h3>
                        <p class="mt-1 text-sm text-gray-600">Les informations principales.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:col-span-2">
                        <x-form.input-text name="name" id="name" label="Nom" class="bg-gray-300 text-gray-900 placeholder:text-gray-400 rounded-md px-3 py-1.5" />
                        <x-form.input-number name="dosage" id="dosage" min="0" label="Dosage" class="bg-gray-300 text-gray-900 placeholder:text-gray-400 rounded-md px-3 py-1.5" />
                    </div>
                </div>
            </div>

            <!-- Section dates -->
            <div class="space-y-4 border-b border-gray-300 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-1">
                        <h3 class="text-base font-semibold text-gray-900">Dates</h3>
                        <p class="mt-1 text-sm text-gray-600">Définissez la période du traitement.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:col-span-2">
                        <x-form.input-date name="start_at" id="start_at" label="Date de début" class="bg-gray-300 text-gray-900 placeholder:text-gray-400 rounded-md px-3 py-1.5" />
                        <x-form.input-date name="end_at" id="end_at" label="Date de fin" class="bg-gray-300 text-gray-900 placeholder:text-gray-400 rounded-md px-3 py-1.5" />
                    </div>
                </div>
            </div>

            <!-- Section type de traitement et fréquences -->
            <div class="space-y-4 border-b border-gray-300 pb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-1">
                        <h3 class="text-base font-semibold text-gray-900">Détails</h3>
                        <p class="mt-1 text-sm text-gray-600">Sélectionnez le type et les fréquences</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:col-span-2">
                        <x-form.type-list name="treatment_type_id" label="Type de traitement" :options="$treatmentTypes->pluck('name', 'id')" :value="old('treatment_type_id')" class="bg-gray-300 text-gray-900 placeholder:text-gray-400 rounded-md px-3 py-1.5" />

                        <div>
                            <h3 class="text-base font-semibold text-gray-900">Fréquences</h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                <x-form.checkbox name="MATIN" label="Matin" />
                                <x-form.checkbox name="APRES_MIDI" label="Après-midi" />
                                <x-form.checkbox name="SOIR" label="Soir" />
                                <x-form.checkbox name="NUIT" label="Nuit" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-x-4">
                <x-form.cancel-button />
                <x-form.submit-button label="Créer le traitement" />
            </div>
        </form>

        <!-- Script pour la gestion des dates -->
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
    </div>
</x-layouts.app>
