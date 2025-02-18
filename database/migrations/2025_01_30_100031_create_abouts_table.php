<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('project_manager_name')->nullable();
            $table->text('project_manager_text')->nullable();
            $table->string('project_manager_photo')->nullable();
            $table->string('project_goal_title')->nullable();
            $table->text('project_goal_text')->nullable();
            $table->string('project_goal_photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
