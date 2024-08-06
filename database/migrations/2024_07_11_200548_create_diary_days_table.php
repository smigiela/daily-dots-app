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
        Schema::create('diary_days', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->text('summary')->nullable();
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_days');
    }
};
