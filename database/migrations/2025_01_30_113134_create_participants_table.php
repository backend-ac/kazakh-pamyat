<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            // place_id - связь с местом (places)
            $table->foreignId('place_id')->constrained()->cascadeOnDelete();

            // Основные поля
            $table->string('name')->nullable();              // ФИО
            $table->text('bio')->nullable();
            $table->string('date_of_birth')->nullable();     // Дата рождения (можно string, можно date)
            $table->string('date_of_death')->nullable();     // Дата смерти (string или date)
            $table->string('where_did_participate')->nullable(); // Где воевал (в зависимости от объёма инфо, возможно text)
            $table->string('photo')->nullable();             // Фото

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
