<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('items', static function (Blueprint $table): void {
            $table->uuid('id');

            $table->string('title');
            $table->string('link')->unique();
            $table->string('short_link')->nullable();
            $table->string('image')->nullable();

            $table->text('description')->nullable();

            $table->json('dub')->nullable();

            $table
                ->foreignUuid('source_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
