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
            $table->foreignId('user_id')->index();
            $table->string('name');
            $table->string('tenancy_db_name')->nullable();
            $table->boolean('personal_company');
            $table->timestamps();
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
