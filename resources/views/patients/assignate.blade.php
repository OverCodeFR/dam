<x-layouts.app>
    <form action="{{ route('patients_users.store') }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
     @csrf

        <x-form.section title="Affiliation de patient à aidant" description="Séléctionner les patient à affilier">
            <x-form.type-list name="patient_id" label="Patient :" :options="$patients->pluck('patient.name', 'id')" :value="old('patient_id')" />
            <x-form.type-list name="user_id" label="Personnel soignant :" :options="$health_users->pluck('name', 'id')" :value="old('user_id')" />
        </x-form.section>

        <x-form.button-group>
            <x-form.cancel-button label="Annuler"/>
            <x-form.submit-button label="Assigner" />
        </x-form.button-group>

</form>
</x-layouts.app>
