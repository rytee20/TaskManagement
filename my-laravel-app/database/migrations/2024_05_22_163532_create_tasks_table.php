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
        Schema::create('task_team_members', function (Blueprint $table) {
            $table->primary(['task_id', 'team_member_id']);
            $table->unsignedBigInteger('task_id'); // Изменено на unsignedBigInteger, чтобы соответствовать типу task_id
            $table->foreign('task_id')->references('task_id')->on('tasks')->onDelete('cascade');
            $table->integer('team_member_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_team_members');
    }
};
