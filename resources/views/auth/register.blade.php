<x-filament-panels::page.simple>
    @if (filament()->hasLogin())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/register.actions.login.before') }}

            {{ $this->loginAction }}
        </x-slot>
    @endif

    <x-filament-panels::form wire:submit="register">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    @if (\TFSThiagoBR98\FilamentTenant\FilamentCompanies::hasSocialiteFeatures())
        <x-filament-companies::socialite :error-message="$errors->first('filament-companies')" />
    @endif
</x-filament-panels::page.simple>
