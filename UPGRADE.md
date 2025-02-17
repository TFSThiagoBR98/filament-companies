# Upgrade Guide

## Upgrading from FilamentCompanies 3.x to 4.x

This major release introduces significant changes designed to streamline the usage of FilamentCompanies. Here’s how to migrate your project from 3.x to 4.x.

### Breaking Changes

1. Removal of Classes:
   - `TFSThiagoBR98\FilamentTenant\Features`
   - `TFSThiagoBR98\FilamentTenant\Providers`
   - `TFSThiagoBR98\FilamentTenant\Socialite`

2. Introduction of Enums:
   - Functionality previously available through the `Providers` class has been replaced by the `TFSThiagoBR98\FilamentTenant\Enums\Provider` enum.
   - Some functionality previously available through the `Socialite` class has been replaced by the `TFSThiagoBR98\FilamentTenant\Enums\Feature` enum.

3. Removal of the `MakeUserCommand` command.
   - It isn't necessary and was removed to simplify the package.

### Migration Steps

#### Dependency Versions

You should first make sure you follow the [Laravel 11 Upgrade Guide](https://laravel.com/docs/11.x/upgrade) and then upgrade your `andrewdwallo/filament-companies` dependency to `^4.0` within your application's `composer.json` file. Then, run the `composer update` command:

    composer update

#### Socialite Providers

For Socialite providers, replace the usage of the `TFSThiagoBR98\FilamentTenant\Providers` class with the `TFSThiagoBR98\FilamentTenant\Enums\Provider` enum.

Before:

```php

use TFSThiagoBR98\FilamentTenant\Providers;

// Enable the following Socialite providers.
Providers::github(),
// And so on for the other providers...

// Determine if the following Socialite providers are enabled.
Providers::hasGithub(),
// And so on for the other providers...
```

After:

```php

use TFSThiagoBR98\FilamentTenant\Enums\Provider;

// Enable the following Socialite providers.
Provider::Github,
// And so on for the other providers...

// Determine if the following Socialite providers are enabled.
Provider::Github->isEnabled(),
// And so on for the other providers...

```

#### Socialite Features

For Socialite features, replace the usage of the `TFSThiagoBR98\FilamentTenant\Socialite` class with the `TFSThiagoBR98\FilamentTenant\Enums\Feature` enum.

Before:

```php

use TFSThiagoBR98\FilamentTenant\Socialite;

// Enable the following features.
Socialite::rememberSession(),
// And so on for the other features...

// Determine if the following features are enabled.
Socialite::hasRememberSessionFeature(),
// And so on for the other features...

```

After:

```php

use TFSThiagoBR98\FilamentTenant\Enums\Feature;

// Enable the following features.
Feature::RememberSession,
// And so on for the other features...

// Determine if the following features are enabled.
Feature::RememberSession->isEnabled(),
// And so on for the other features...
```

### Important Notes
> The rest of the methods previously available in the `Socialite` and `Features` classes are still available and were moved to the main `TFSThiagoBR98\FilamentTenant\FilamentCompanies` class.

### Further Assistance
Should you encounter any issues during the upgrade process, please don’t hesitate to reach out Discord or by creating a new Discussion on GitHub.
