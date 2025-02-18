<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->string('sender_name')->nullable();  // ФИО отправителя
            $table->text('user_message')->nullable();   // Сообщение
            $table->string('type')->default('official'); // 'user_story' или 'official'
        });
    }

    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('sender_name');
            $table->dropColumn('user_message');
            $table->dropColumn('type');
        });
    }
};
