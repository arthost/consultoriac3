<?php

use App\Models\Form;
use App\Models\MunicipiosEstados;
use App\Models\User;
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
        Schema::create('simulations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Form::class)->index()->nullable();
            $table->foreignId('created_by')->index()
                ->nullable()->constrained('users');
            $table->string('form_type')->nullable()->index();
            $table->foreignIdFor(MunicipiosEstados::class)->nullable()->index();
            $table->string('name');
            $table->string('email')->index();
            $table->string('phone');
            $table->string('document')->nullable()->index();
            $table->json('answers')->nullable()->index();

            $table->index(['created_by', 'form_type', 'form_id']);
            $table->index(['created_by','form_type']);
            $table->index(['created_by','form_id']);
            $table->index(['created_by', 'document']);
            $table->index(['created_by', 'municipios_estados_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulations');
    }
};
