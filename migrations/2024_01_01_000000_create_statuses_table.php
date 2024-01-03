<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mr_vaco__statuses', function(Blueprint $table)
        {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#000000');
            $table->boolean('active')->default(false);
            $table->boolean('disabled')->default(false);
            $table->boolean('draft')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mr_vaco__statuses');
    }
};
