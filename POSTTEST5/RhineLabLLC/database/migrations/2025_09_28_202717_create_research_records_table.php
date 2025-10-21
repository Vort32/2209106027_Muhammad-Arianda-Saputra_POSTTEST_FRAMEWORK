<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('record_code')->unique();
            $table->string('classification')->default('internal');
            $table->string('status')->default('draft');
            $table->date('recorded_at')->nullable();
            $table->text('summary');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_records');
    }
};
