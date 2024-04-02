<?php

namespace TFSThiagoBR98\FilamentTenant\Concerns\Base;

use TFSThiagoBR98\FilamentTenant\Contracts\AddsCompanyEmployees;
use TFSThiagoBR98\FilamentTenant\Contracts\CreatesCompanies;
use TFSThiagoBR98\FilamentTenant\Contracts\CreatesNewUsers;
use TFSThiagoBR98\FilamentTenant\Contracts\DeletesCompanies;
use TFSThiagoBR98\FilamentTenant\Contracts\DeletesUsers;
use TFSThiagoBR98\FilamentTenant\Contracts\InvitesCompanyEmployees;
use TFSThiagoBR98\FilamentTenant\Contracts\RemovesCompanyEmployees;
use TFSThiagoBR98\FilamentTenant\Contracts\UpdatesCompanyNames;
use TFSThiagoBR98\FilamentTenant\Contracts\UpdatesUserPasswords;
use TFSThiagoBR98\FilamentTenant\Contracts\UpdatesUserProfileInformation;

trait HasBaseActionBindings
{
    /**
     * Register a class / callback that should be used to create new users.
     */
    public static function createUsersUsing(string $class): void
    {
        app()->singleton(CreatesNewUsers::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user profile information.
     */
    public static function updateUserProfileInformationUsing(string $class): void
    {
        app()->singleton(UpdatesUserProfileInformation::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user passwords.
     */
    public static function updateUserPasswordsUsing(string $class): void
    {
        app()->singleton(UpdatesUserPasswords::class, $class);
    }

    /**
     * Register a class / callback that should be used to create companies.
     */
    public static function createCompaniesUsing(string $class): void
    {
        app()->singleton(CreatesCompanies::class, $class);
    }

    /**
     * Register a class / callback that should be used to update company names.
     */
    public static function updateCompanyNamesUsing(string $class): void
    {
        app()->singleton(UpdatesCompanyNames::class, $class);
    }

    /**
     * Register a class / callback that should be used to add company employees.
     */
    public static function addCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(AddsCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to add company employees.
     */
    public static function inviteCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(InvitesCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to remove company employees.
     */
    public static function removeCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(RemovesCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete companies.
     */
    public static function deleteCompaniesUsing(string $class): void
    {
        app()->singleton(DeletesCompanies::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete users.
     */
    public static function deleteUsersUsing(string $class): void
    {
        app()->singleton(DeletesUsers::class, $class);
    }
}
