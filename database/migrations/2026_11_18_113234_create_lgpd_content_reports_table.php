<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('lgpd-takedown.table', 'lgpd_content_reports'), function (Blueprint $table) {
            $table->id();
            $table->morphs('content');
            $table->nullableMorphs('reporter');
            $table->string('reporter_name');
            $table->string('reporter_email')->index();
            $table->string('reporter_role', 20);
            $table->string('category', 30);
            $table->text('description')->nullable();
            $table->boolean('reporter_flagged')->default(false);
            $table->string('status', 10)->default('open');
            $table->text('decision')->nullable();
            $table->boolean('automated')->default(false);
            $table->timestamp('decided_at')->nullable();
            $table->timestamp('authority_reported_at')->nullable();
            $table->string('authority_protocol')->nullable();
            $table->timestamp('retain_until')->nullable();
            $table->timestamp('author_notified_at')->nullable();
            $table->timestamp('appeal_until')->nullable();
            $table->text('appeal')->nullable();
            $table->timestamp('appealed_at')->nullable();
            $table->text('appeal_decision')->nullable();
            $table->timestamp('appeal_decided_at')->nullable();
            $table->timestamp('restored_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('lgpd-takedown.table', 'lgpd_content_reports'));
    }
};
