<?php

namespace TFSThiagoBR98\FilamentTenant\Pages\Company;

use Filament\Facades\Filament;
use Filament\Pages\Tenancy\EditTenantProfile as BaseEditTenantProfile;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;

use function Filament\authorize;

class CompanySettings extends BaseEditTenantProfile
{
    protected static string $view = 'filament-companies::filament.pages.companies.company_settings';

    public static function getLabel(): string
    {
        return __('filament-companies::default.pages.titles.company_settings');
    }

    public static function getRelativeRouteName(): string
    {
        return 'profile';
    }

    public static function getRouteName(?string $panel = null): string
    {
        $panel = $panel ? Filament::getPanel($panel) : Filament::getCurrentPanel();

        return $panel->generateRouteName(static::getRelativeRouteName());
    }

    public static function canView(Model $tenant): bool
    {
        try {
            return authorize('view', $tenant)->allowed();
        } catch (AuthorizationException $exception) {
            return $exception->toResponse()->allowed();
        }
    }

    protected function getViewData(): array
    {
        return [
            'company' => Filament::getTenant(),
        ];
    }
}
