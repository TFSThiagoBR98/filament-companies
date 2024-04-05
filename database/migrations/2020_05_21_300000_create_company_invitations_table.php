<?php

use App\Models\CompanyInvitation;
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
        Schema::create(CompanyInvitation::TABLE, function (Blueprint $table) {
            $table->uuid(CompanyInvitation::ATTRIBUTE_ID)->primary();
            $table->foreignUuid(CompanyInvitation::ATTRIBUTE_FK_COMPANY_ID)->constrained()->cascadeOnDelete();
            $table->string(CompanyInvitation::ATTRIBUTE_EMAIL);
            $table->string(CompanyInvitation::ATTRIBUTE_ROLE)->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();

            $table->unique([CompanyInvitation::ATTRIBUTE_FK_COMPANY_ID, CompanyInvitation::ATTRIBUTE_EMAIL]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(CompanyInvitation::TABLE);
    }
};
