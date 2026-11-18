<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(config('lgpd-records.table', 'lgpd_processing_activities'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('purpose');
            $table->string('legal_basis', 30)->nullable();
            $table->json('data_subjects')->nullable();
            $table->json('data_categories')->nullable();
            // Models of lgpd.models processed by this activity: their #[PersonalData] columns join the record.
            $table->json('models')->nullable();
            $table->json('recipients')->nullable();
            $table->json('international_transfers')->nullable();
            $table->string('retention')->nullable();
            $table->text('security_measures')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(config('lgpd-records.table', 'lgpd_processing_activities'));
    }
};
