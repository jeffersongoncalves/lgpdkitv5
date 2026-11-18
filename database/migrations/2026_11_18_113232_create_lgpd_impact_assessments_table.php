<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('lgpd-ripd.table', 'lgpd_impact_assessments'), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // laravel-lgpd-records ProcessingActivity, without a foreign key so the table order doesn't matter.
            $table->unsignedBigInteger('processing_activity_id')->nullable()->index();
            $table->text('description')->nullable();
            $table->text('necessity')->nullable();
            $table->json('risks')->nullable();
            $table->text('dpo_opinion')->nullable();
            $table->string('status', 10)->default('draft');
            $table->timestamp('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamp('next_review_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('lgpd-ripd.table', 'lgpd_impact_assessments'));
    }
};
