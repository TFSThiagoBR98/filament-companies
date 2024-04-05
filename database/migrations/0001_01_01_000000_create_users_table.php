<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(User::TABLE, function (Blueprint $table) {
            $table->uuid(User::ATTRIBUTE_ID)->primary();
            $table->string(User::ATTRIBUTE_NAME);
            $table->string(User::ATTRIBUTE_EMAIL)->unique();
            $table->string(User::ATTRIBUTE_TAX_ID)->nullable();
            $table->timestamp(User::ATTRIBUTE_EMAIL_VERIFIED_AT)->nullable();
            $table->string(User::ATTRIBUTE_PASSWORD)->nullable(
                FilamentCompanies::hasSocialiteFeatures()
            );
            $table->rememberToken();
            $table->foreignId(User::ATTRIBUTE_FK_CURRENT_COMPANY_ID)->nullable();
            $table->foreignId(User::ATTRIBUTE_FK_CURRENT_CONNECTED_ACCOUNT_ID)->nullable();
            $table->string(User::ATTRIBUTE_PROFILE_PHOTO_URL, 2048)->nullable();

            $table->schemalessAttributes(User::ATTRIBUTE_EXTRA_ATTRIBUTES);

            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(User::TABLE);
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
