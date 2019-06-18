<?php

namespace Tests\Feature;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Models\Delivery;
use App\Domain\Customer\Models\Customer;
use App\Domain\State\Models\Location;
use App\ProviderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeliverCarsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_will_deliver_car_from_car_location_to_customer()
    {
        $location = factory(Location::class)->create();
        $company = factory(Company::class)->create();
        $customer = factory(Customer::class)->create();
        $model = 'A4';

        $provider = ProviderService::deliverFrom($location)
            ->fromCompany($company)
            ->withModel($model)
            ->toCustomer($customer);

        $this->assertInstanceOf(Delivery::class, $provider->makeDelivery());
    }
}
