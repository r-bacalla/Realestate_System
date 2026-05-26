<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leases', function (Blueprint $table) {

            $table->id();

            $table->string('lease_number')->unique();

            $table->foreignId('property_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('tenant_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('start_date');
            $table->date('end_date');

            $table->decimal('monthly_rent',12,2);
            $table->decimal('deposit_amount',12,2)->nullable();

            $table->integer('payment_day')->nullable();

            $table->string('status')->default('pending');

            $table->text('terms')->nullable();

            $table->timestamp('signed_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leases');
    }
};