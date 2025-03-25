<?php

use App\Enums\BlogStatus;
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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();

            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('status', array_map(fn ($status) => $status->value, BlogStatus::cases()))
                ->default(BlogStatus::PUBLISHED->value);
            $table->string('banner_path')->nullable();
            $table->longText('details');
            $table->unsignedBigInteger('hit_count')->default(0);
            $table->timestamps();

            $table->index('title');
            $table->index('slug');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
