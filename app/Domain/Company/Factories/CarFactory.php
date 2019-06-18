<?php

namespace App\Domain\Company\Factories;


use App\Domain\Company\Models\Car;
use App\Domain\Company\Models\Company;
use App\Exceptions\ProviderServiceException;

class CarFactory
{
    public function __invoke(Company $company, string $model)
    {
        if (! $company->has($model)) {
            throw ProviderServiceException::invalidCarModel($model, $company->name);
        }

        return Car::create([
            'company_id' => $company->id,
            'model_id' => optional($company->getModel($model))->id,
        ]);
    }
}