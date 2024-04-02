<x-filament-panels::page>
    @livewire(\TFSThiagoBR98\FilamentTenant\Http\Livewire\UpdateCompanyNameForm::class, compact('company'))

    @livewire(\TFSThiagoBR98\FilamentTenant\Http\Livewire\CompanyEmployeeManager::class, compact('company'))

    @if (!$company->personal_company && Gate::check('delete', $company))
        <x-filament-companies::section-border />
        @livewire(\TFSThiagoBR98\FilamentTenant\Http\Livewire\DeleteCompanyForm::class, compact('company'))
    @endif
</x-filament-panels::page>
