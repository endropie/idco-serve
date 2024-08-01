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

        Schema::create('receive_orders', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('PURCHASE');
            $table->string('number');
            $table->date('date');
            $table->date('due')->nullable();
            $table->string('reference')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained()->on('customers')->references('id')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->string('customer_name')->nullable();
            $table->string('customer_contact')->nullable();
            $table->text('customer_address')->nullable();

            $table->text('description')->nullable();

            $table->foreignId('created_uid');
            $table->timestamps();

        });

        Schema::create('receive_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receive_order_id')->constrained()->on('receive_orders')->references('id')->cascadeOnDelete();

            $table->string('name');
            $table->integer('quantity');
            $table->string('condition')->nullable();
            $table->string('hrc')->nullable();

            $table->jsonb('dimension')->nullable();
            $table->foreignId('protype_id')->constrained()->on('protypes')->references('id')->restrictOnDelete();
            $table->foreignId('material_id')->constrained()->on('materials')->references('id')->restrictOnDelete();
            $table->foreignId('coat_id')->constrained()->on('coats')->references('id')->restrictOnDelete();

            $table->string('rtype')->constrained()->on('rtypes')->references('code')->restrictOnDelete();
            $table->string('r0type')->constrained()->on('r0types')->references('code')->restrictOnDelete();
            $table->string('fltype')->constrained()->on('fltypes')->references('code')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receive_order_items');
        Schema::dropIfExists('receive_orders');
    }
};
