<x-layouts.app>
    <form action="{{ route('patient_user.store') }}" method="POST" class="bg-gray-200 p-6 rounded-md shadow-sm space-y-12">
     @csrf

        <x-form.section title="Affiliation de patient à aidant" description="Séléctionner les patient à affilier">
            @if(auth()->user()->role->key === 'admin')
                <x-form.type-list name="patient_id" label="Patient :" :options="$patients->pluck('name', 'id')" :value="old('patient_id')" />
                <x-form.type-list name="healthcare_id" label="Personnel soignant :" :options="$healthcare->pluck('name', 'id')" :value="old('healthcare_id')" />
            @else
                <x-form.type-list name="patient_id" label="Patient :" :options="$patients->pluck('patient.name', 'patient.id')" :value="old('patient_id')" />
            @endif
            <x-form.type-list name="helper_id" label="Aidant :" :options="$helper->pluck('name', 'id')" :value="old('helper_id')" />
        </x-form.section>

        <x-form.button-group>
            <x-form.cancel-button label="Annuler"/>
            <x-form.submit-button label="Assigner" />
        </x-form.button-group>

</form>
</x-layouts.app>
