<?php

namespace App;

use App\Domain\State\Models\Location;
use App\Domain\Company\Models\Company;
use App\Domain\Company\Models\Delivery;
use App\Domain\Company\DTO\DeliveryData;
use App\Domain\Customer\Models\Customer;
use App\Domain\Company\Factories\CarFactory;
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

    /**
     * create delivery from specifec location
     *
     * @param  \App\Domain\State\Models\Location $location
     *
     * @return ProviderService
     */
    public static function deliverFrom(Location $location)
    {
        return new self($location);
    }

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * perform a delivery on collected data
     *
     * @return \App\Domain\Company\Models\Delivery
     */
    public function makeDelivery(): Delivery
    {
        /**
         * using dto for properties to unsure correctness of
         * delivery data and also making that data immutable
         * so ti cant be changed once raedy for delivery
         *
         * @var \App\Domain\Company\DTO\DeliveryData $deliveryData
         */
        $deliveryData = DeliveryData::immutable([
            'customer' => $this->customer,
            'location' => $this->location,
            'model' => $this->model
        ]);

        // throw exception when customer and delivery car location doesn't match
        if ($deliveryData->customer->state() !== $deliveryData->location->name) {
            throw ProviderServiceException::locationMismatch();
        }

        // creating a car from factory with company and model
        $this->car = (new CarFactory())($this->company, $deliveryData->model);

        return $this->car->deliverTo($deliveryData->customer);
    }

    /**
     * set customer to which car is being deliver
     *
     * @param \App\Domain\Customer\Models\Customer $customer
     *
     * @return ProviderService
     */
    public function toCustomer(Customer $customer): ProviderService
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * set car model type
     *
     * @param string $model
     *
     * @return ProviderService
     */
    public function withModel(string $model): ProviderService
    {
        $this->model = $model;

        return $this;
    }

    /**
     * set company of car model type
     *
     * @param \App\Domain\Company\Models\Company $company
     *
     * @return ProviderService
     */
    public function fromCompany(Company $company): ProviderService
    {
        $this->company = $company;

        return $this;
    }
}
