<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('lgpd-minors.tables.assurances', 'lgpd_age_assurances'), function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->string('band', 20);
            $table->string('method', 30);
            $table->string('provider')->nullable();
            $table->timestamp('assured_at');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });

        Schema::create(config('lgpd-minors.tables.guardians', 'lgpd_guardian_links'), function (Blueprint $table) {
            $table->id();
            $table->morphs('minor');
            $table->morphs('guardian');
            $table->string('relationship')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->timestamps();
        });

        Schema::create(config('lgpd-minors.tables.suspensions', 'lgpd_minor_suspensions'), function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');
            $table->text('reason');
            $table->text('appeal')->nullable();
            $table->timestamp('appealed_at')->nullable();
            $table->string('outcome', 10)->nullable();
            $table->text('decision')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('lgpd-minors.tables.suspensions', 'lgpd_minor_suspensions'));
        Schema::dropIfExists(config('lgpd-minors.tables.guardians', 'lgpd_guardian_links'));
        Schema::dropIfExists(config('lgpd-minors.tables.assurances', 'lgpd_age_assurances'));
    }
};
