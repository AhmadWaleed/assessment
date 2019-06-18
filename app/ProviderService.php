<?php

namespace App;


use App\Domain\Company\Factories\CarFactory;
use App\Domain\Company\Models\Company;
use App\Domain\Company\Models\Model;
use App\Domain\Customer\Models\Customer;
use App\Domain\State\Models\Location;
use App\Exceptions\ProviderServiceException;

class ProviderService
{
    /** @var \App\Domain\State\Models\Location */
    protected $location;

    /** @var \App\Domain\Company\Models\Company */
    protected $company;

    /** @var \App\Domain\Customer\Models\Customer */
    protected $customer;

    /** @var \App\Domain\Company\Models\Model */
    protected $model;

    /** @var \App\Domain\Company\Models\Car */
    protected $car;

    public static function deliverFrom(Location $location)
    {
        return new self($location);
    }

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function makeDelivery(Customer $customer)
    {
        if ($customer->state() !== $this->location->name) {
            throw ProviderServiceException::locationMismatch();
        }

        $this->car = (new CarFactory())($this->company, $this->model);

        $this->car->deliverTo($this->customer);
    }

    public function toCustomer(Customer $customer): ProviderService
    {
        $this->customer = $customer;

        return $this;
    }

    public function withModel(Model $model): ProviderService
    {
        $this->model = $model;

        return $this;
    }

    public function fromCompany(Company $company): ProviderService
    {
        $this->company = $company;

        return $this;
    }
}