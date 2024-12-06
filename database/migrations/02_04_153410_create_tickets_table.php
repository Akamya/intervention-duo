<?php

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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->enum('statut', ['Done', 'Pending', 'ToDo'])->default('todo');
            $table->enum('categorie', [
                'Bug',
                'Reparation',
                'Modification',
                'Entretien',
                'Logicielle',
                'Restauration',
                'Installation',
                'Cafe'
            ]);
            $table->string('commentaire')->nullable();
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
