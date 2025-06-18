<?php

use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('treatment_intakes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('taken_at')->useCurrent();
            $table->float('amount');
            $table->foreignIdFor(Patient::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Treatment::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_intakes');
    }
};
