<?php

namespace TFSThiagoBR98\FilamentTenant\Pages\Auth;

use Filament\Forms\Form;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;
use TFSThiagoBR98\FilamentTwoFactor\Http\Livewire\Auth\Login as FilamentLogin;

class Login extends FilamentLogin
{
    public static string $view = 'filament-companies::auth.login';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data')
            ->model(FilamentCompanies::userModel());
    }
}
