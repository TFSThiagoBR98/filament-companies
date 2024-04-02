<?php

namespace App\Actions\FilamentCompanies;

use App\Models\Company;
use TFSThiagoBR98\FilamentTenant\Contracts\DeletesCompanies;

class DeleteCompany implements DeletesCompanies
{
    /**
     * Delete the given company.
     */
    public function delete(Company $company): void
    {
        $company->purge();
    }
}
