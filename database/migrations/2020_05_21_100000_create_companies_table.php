<?php

use App\Models\Company;
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
        Schema::create(Company::TABLE, function (Blueprint $table) {
            $table->uuid(Company::ATTRIBUTE_ID)->primary();
            $table->foreignUuid(Company::ATTRIBUTE_FK_USER_ID)->index();
            $table->string(Company::ATTRIBUTE_SLUG);
            $table->string(Company::ATTRIBUTE_NAME);
            $table->string(Company::ATTRIBUTE_TAX_ID)->nullable();
            $table->string(Company::ATTRIBUTE_TENANCY_DB_NAME)->nullable();
            $table->string(Company::ATTRIBUTE_STATUS)->nullable();
            $table->boolean(Company::ATTRIBUTE_PERSONAL_COMPANY)->default(true);
            $table->boolean(Company::ATTRIBUTE_VISIBLE_TO_CLIENT)->default(true);
            $table->schemalessAttributes(Company::ATTRIBUTE_EXTRA_ATTRIBUTES);
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Company::TABLE);
    }
};
