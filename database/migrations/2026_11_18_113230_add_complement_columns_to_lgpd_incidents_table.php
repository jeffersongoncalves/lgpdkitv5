<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(config('lgpd-incidents.table', 'lgpd_incidents'), function (Blueprint $table) {
            // Set when the ANPD notice was partial (Res. CD/ANPD 15/2024, art. 6, §3).
            $table->timestamp('complement_due_at')->nullable()->index();
            $table->timestamp('complemented_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table(config('lgpd-incidents.table', 'lgpd_incidents'), function (Blueprint $table) {
            $table->dropIndex(['complement_due_at']);
            $table->dropColumn(['complement_due_at', 'complemented_at']);
        });
    }
};
