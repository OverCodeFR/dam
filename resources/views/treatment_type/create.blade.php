<x-layouts.app>
    <div class="container mx-auto px-4 py-6">
        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-700 border border-red-300">
                <strong>Erreur :</strong> Veuillez corriger les champs ci-dessous.
            </div>
        @endif
        <x-form.form-header
            title="Ajouter un type de traitement"
            description="Remplissez les champs suivants pour ajouter un nouveau type de traitement."
        />

        <form action="{{ route('treatments_types.store') }}" method="POST" class="space-y-4">
            @csrf

            <x-form.input-text  name="name" id="name"  label="Type de traitement" />
            <x-form.type-list name="module" label="Module associé" :options="$modules" :value="old('module', $treatment->module ?? null)"/>





            <x-form.submit-button label="Ajouter le type" />
            <x-form.cancel-button/>

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

