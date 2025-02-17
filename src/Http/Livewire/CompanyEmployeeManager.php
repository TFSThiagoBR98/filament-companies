<?php

namespace TFSThiagoBR98\FilamentTenant\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use TFSThiagoBR98\FilamentTenant\Actions\UpdateCompanyEmployeeRole;
use TFSThiagoBR98\FilamentTenant\Contracts\AddsCompanyEmployees;
use TFSThiagoBR98\FilamentTenant\Contracts\InvitesCompanyEmployees;
use TFSThiagoBR98\FilamentTenant\Contracts\RemovesCompanyEmployees;
use TFSThiagoBR98\FilamentTenant\FilamentCompanies;
use TFSThiagoBR98\FilamentTenant\RedirectsActions;
use TFSThiagoBR98\FilamentTenant\Models\Role;

class CompanyEmployeeManager extends Component
{
    use RedirectsActions;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * The user that is having their role managed.
     */
    public mixed $managingRoleFor;

    /**
     * The current role for the user that is having their role managed.
     */
    public ?string $currentRole;

    /**
     * The ID of the company employee being removed.
     */
    public $companyEmployeeIdBeingRemoved = null;

    /**
     * The "add company employee" form state.
     *
     * @var array<string, mixed>
     */
    public $addCompanyEmployeeForm = [
        'email' => '',
        'role' => null,
    ];

    /**
     * Mount the component.
     */
    public function mount(mixed $company): void
    {
        $this->company = $company;
    }

    /**
     * Add a new company employee to a company.
     */
    public function addCompanyEmployee(InvitesCompanyEmployees $inviter, AddsCompanyEmployees $adder): void
    {
        $this->resetErrorBag();

        if (FilamentCompanies::sendsCompanyInvitations()) {
            $inviter->invite(
                $this->user,
                $this->company,
                $this->addCompanyEmployeeForm['email'],
                $this->addCompanyEmployeeForm['role']
            );
        } else {
            $adder->add(
                $this->user,
                $this->company,
                $this->addCompanyEmployeeForm['email'],
                $this->addCompanyEmployeeForm['role']
            );
        }

        if (FilamentCompanies::hasNotificationsFeature()) {
            if (method_exists($inviter, 'employeeInvitationSent')) {
                $inviter->employeeInvitationSent(
                    $this->user,
                    $this->company,
                    $this->addCompanyEmployeeForm['email'],
                    $this->addCompanyEmployeeForm['role']
                );
            } else {
                $email = $this->addCompanyEmployeeForm['email'];
                $this->employeeInvitationSent($email);
            }
        }

        $this->addCompanyEmployeeForm = [
            'email' => '',
            'role' => null,
        ];

        $this->company = $this->company->fresh();
    }

    /**
     * Cancel a pending company employee invitation.
     */
    public function cancelCompanyInvitation(int|string $invitationId): void
    {
        if (! empty($invitationId)) {
            $model = FilamentCompanies::companyInvitationModel();

            $model::whereKey($invitationId)->delete();
        }

        $this->company = $this->company->fresh();
    }

    /**
     * Allow the given user's role to be managed.
     */
    public function manageRole(int|string $userId): void
    {
        $this->dispatch('open-modal', id: 'currentlyManagingRole');
        $this->managingRoleFor = FilamentCompanies::findUserByIdOrFail($userId);
        $this->currentRole = $this->managingRoleFor->companyRole($this->company)->name;
    }

    /**
     * Save the role for the user being managed.
     *
     * @throws AuthorizationException
     */
    public function updateRole(UpdateCompanyEmployeeRole $updater): void
    {
        $updater->update(
            $this->user,
            $this->company,
            $this->managingRoleFor->id,
            $this->currentRole
        );

        $this->company = $this->company->fresh();

        $this->dispatch('close-modal', id: 'currentlyManagingRole');
    }

    /**
     * Stop managing the role of a given user.
     */
    public function stopManagingRole(): void
    {
        $this->dispatch('close-modal', id: 'currentlyManagingRole');
    }

    /**
     * Confirm that the currently authenticated user should leave the company.
     */
    public function confirmLeavingCompany(): void
    {
        $this->dispatch('open-modal', id: 'confirmingLeavingCompany');
    }

    /**
     * Remove the currently authenticated user from the company.
     */
    public function leaveCompany(RemovesCompanyEmployees $remover): Response | Redirector | RedirectResponse
    {
        $remover->remove(
            $this->user,
            $this->company,
            $this->user
        );

        $this->dispatch('close-modal', id: 'confirmingLeavingCompany');

        $this->company = $this->company->fresh();

        return $this->redirectPath($remover);
    }

    /**
     * Cancel leaving the company.
     */
    public function cancelLeavingCompany(): void
    {
        $this->dispatch('close-modal', id: 'confirmingLeavingCompany');
    }

    /**
     * Confirm that the given company employee should be removed.
     */
    public function confirmCompanyEmployeeRemoval(int|string $userId): void
    {
        $this->dispatch('open-modal', id: 'confirmingCompanyEmployeeRemoval');
        $this->companyEmployeeIdBeingRemoved = $userId;
    }

    /**
     * Remove a company employee from the company.
     */
    public function removeCompanyEmployee(RemovesCompanyEmployees $remover): void
    {
        $remover->remove(
            $this->user,
            $this->company,
            $user = FilamentCompanies::findUserByIdOrFail($this->companyEmployeeIdBeingRemoved)
        );

        $this->dispatch('close-modal', id: 'confirmingCompanyEmployeeRemoval');

        $this->companyEmployeeIdBeingRemoved = null;

        $this->company = $this->company->fresh();
    }

    /**
     * Cancel the removal of a company employee.
     */
    public function cancelCompanyEmployeeRemoval(): void
    {
        $this->dispatch('close-modal', id: 'confirmingCompanyEmployeeRemoval');
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * Get the available company employee roles.
     */
    public function getRolesProperty(): Collection
    {
        return Role::all();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::companies.company-employee-manager');
    }

    public function employeeInvitationSent($email): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.company_invitation_sent.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-companies::default.notifications.company_invitation_sent.body', compact('email'))))
            ->send();
    }
}
