<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('lgpd-vendors.table', 'lgpd_vendors'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document')->nullable();
            $table->string('role', 20);
            $table->text('services')->nullable();
            $table->json('data_categories')->nullable();
            $table->string('country', 2)->default('BR');
            $table->string('transfer_mechanism', 30)->nullable();
            $table->string('risk', 10)->default('medium');
            $table->date('dpa_signed_at')->nullable();
            $table->date('dpa_expires_at')->nullable();
            $table->json('dpa_checklist')->nullable();
            $table->string('contact')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('terminated_at')->nullable();
            $table->timestamp('data_returned_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('lgpd-vendors.table', 'lgpd_vendors'));
    }
};
