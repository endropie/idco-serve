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
        Schema::create('rtypes', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('notes')->nullable();
        });

        Schema::create('r0types', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('notes')->nullable();
        });

        Schema::create('fltypes', function (Blueprint $table) {
            $table->string('code')->primary();
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rtypes');
        Schema::dropIfExists('r0types');
        Schema::dropIfExists('fltypes');
    }
};
