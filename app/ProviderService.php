<?php

namespace App;


use App\Domain\Company\DTO\DeliveryData;
use App\Domain\Company\Factories\CarFactory;
use App\Domain\Company\Models\Company;
use App\Domain\Company\Models\Delivery;
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

    /** @var string */
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

    public function makeDelivery(): Delivery
    {
        /** @var \App\Domain\Company\DTO\DeliveryData $deliveryData */
        $deliveryData = DeliveryData::immutable([
            'customer' => $this->customer,
            'location' => $this->location,
            'model' => $this->model
        ]);

        if ($deliveryData->customer->state() !== $deliveryData->location->name) {
            throw ProviderServiceException::locationMismatch();
        }

        $this->car = (new CarFactory())($this->company, $deliveryData->model);

        return $this->car->deliverTo($deliveryData->customer);
    }

    public function toCustomer(Customer $customer): ProviderService
    {
        $this->customer = $customer;

        return $this;
    }

    public function withModel(string $model): ProviderService
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