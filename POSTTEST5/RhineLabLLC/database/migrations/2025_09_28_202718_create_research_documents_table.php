<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_record_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->string('document_type');
            $table->string('access_level')->default('restricted');
            $table->string('storage_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_documents');
    }
};
