<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('img')->nullable();
            $table->string('video')->nullable();

            // Поле для связи со страницей (может быть null)
            $table->foreignId('page_id')
                ->nullable()
                ->constrained('pages')
                ->cascadeOnDelete();

            // Флаг "general" для компонента, который должен быть доступен «везде»
            $table->boolean('is_general')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('components');
    }
};
