<?php

namespace App\Livewire;

use App\Models\PatientUser;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Patient;
use Illuminate\Support\Str;



class Token extends Component
{
    public Patient $patient;
    public ?string $token = null;

    public function mount(Patient $patient)
    {
        Gate::authorize('generateToken', Patient::class);

        $this->patient = $patient;
        $this->token = null;
    }

    public function generateToken()
    {
        Gate::authorize('generateToken', Patient::class);

        $this->patient->tokens()->delete();

        $tokenResult = $this->patient->createToken('api_token');

        $this->token = $tokenResult->plainTextToken;
    }

    public function render()
    {
        return view('livewire.token')->layout('components.layouts.app');
    }
}


