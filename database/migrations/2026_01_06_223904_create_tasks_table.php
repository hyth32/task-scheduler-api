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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('type');
            $table->text('status');

            $table->timestamp('run_at');
            $table->timestamp('started_at');
            $table->timestamp('finished_at');

            $table->json('payload')->nullable();

            $table->integer('retries')->default(0);
            $table->integer('max_retries')->default(3);

            $table->integer('timeout_sec')->default(30);

            $table->foreignId('owner_user_id')->constrained('users');

            $table->timestamps();

            $table->index(['status', 'run_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
