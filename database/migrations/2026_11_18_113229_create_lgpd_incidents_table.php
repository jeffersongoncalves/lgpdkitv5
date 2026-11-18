<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('lgpd-incidents.table', 'lgpd_incidents'), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('occurred_at')->nullable();
            // When the controller learned the incident affected personal data: the deadline starts here.
            $table->timestamp('discovered_at');
            $table->timestamp('due_at')->index();
            // Null while under assessment.
            $table->string('risk', 20)->nullable();
            $table->json('data_categories')->nullable();
            $table->unsignedInteger('affected_subjects')->nullable();
            $table->text('measures')->nullable();
            $table->timestamp('anpd_notified_at')->nullable();
            $table->string('anpd_protocol')->nullable();
            $table->timestamp('subjects_notified_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('lgpd-incidents.table', 'lgpd_incidents'));
    }
};
