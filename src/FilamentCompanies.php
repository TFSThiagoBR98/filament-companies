<?php

namespace TFSThiagoBR98\FilamentTenant;

use Filament\Contracts\Plugin;
use Filament\Events\TenantSet;
use Filament\Panel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use TFSThiagoBR98\FilamentTenant\Contracts\CreatesConnectedAccounts;
use TFSThiagoBR98\FilamentTenant\Contracts\CreatesUserFromProvider;
use TFSThiagoBR98\FilamentTenant\Contracts\HandlesInvalidState;
use TFSThiagoBR98\FilamentTenant\Contracts\UpdatesConnectedAccounts;
use TFSThiagoBR98\FilamentTenant\Http\Controllers\OAuthController;
use TFSThiagoBR98\FilamentTenant\Listeners\SwitchCurrentCompany;
use TFSThiagoBR98\FilamentTenant\Pages\Company\CompanySettings;
use TFSThiagoBR98\FilamentTenant\Pages\Company\CreateCompany;

class FilamentCompanies implements Plugin
{
    use Concerns\Base\HasAddedProfileComponents;
    use Concerns\Base\HasBaseActionBindings;
    use Concerns\Base\HasBaseModels;
    use Concerns\Base\HasBaseProfileComponents;
    use Concerns\Base\HasBaseProfileFeatures;
    use Concerns\Base\HasCompanyFeatures;
    use Concerns\Base\HasModals;
    use Concerns\Base\HasNotifications;
    use Concerns\Base\HasPanels;
    use Concerns\Base\HasPermissions;
    use Concerns\Base\HasRoutes;
    use Concerns\Base\HasTermsAndPrivacyPolicy;
    use Concerns\ManagesProfileComponents;
    use Concerns\Socialite\CanEnableSocialite;
    use Concerns\Socialite\HasConnectedAccountModel;
    use Concerns\Socialite\HasProviderFeatures;
    use Concerns\Socialite\HasProviders;
    use Concerns\Socialite\HasSocialiteActionBindings;
    use Concerns\Socialite\HasSocialiteComponents;
    use Concerns\Socialite\HasSocialiteProfileFeatures;

    public function getId(): string
    {
        return 'companies';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        if (static::hasCompanyFeatures()) {
            Livewire::component('filament.pages.companies.create_company', CreateCompany::class);
            Livewire::component('filament.pages.companies.company_settings', CompanySettings::class);
        }

        if (static::hasSocialiteFeatures()) {
            app()->bind(OAuthController::class, static function (Application $app) {
                return new OAuthController(
                    $app->make(CreatesUserFromProvider::class),
                    $app->make(CreatesConnectedAccounts::class),
                    $app->make(UpdatesConnectedAccounts::class),
                    $app->make(HandlesInvalidState::class),
                );
            });
        }

        if (static::$registersRoutes) {
            $panel->routes(fn () => $this->registerPublicRoutes());
            $panel->authenticatedRoutes(fn () => $this->registerAuthenticatedRoutes());
        }
    }

    public function boot(Panel $panel): void
    {
        if (static::switchesCurrentCompany()) {
            Event::listen(TenantSet::class, SwitchCurrentCompany::class);
        }
    }
}
