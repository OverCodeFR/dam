<?php

use App\Models\Frequency;
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
        Schema::create('treatment_frequencies', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('amount');
            $table->foreignIdFor(Frequency::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Treatment::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_frequencies');
    }
};
