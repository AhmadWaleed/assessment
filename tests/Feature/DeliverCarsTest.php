<?php

namespace Tests\Feature;

use App\Domain\Company\Models\Company;
use App\Domain\Company\Models\Delivery;
use App\Domain\Company\Models\Model;
use App\Domain\Customer\Models\Customer;
use App\Domain\State\Models\Location;
use App\ProviderService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliverCarsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_ensures_car_deliver_to_customers()
    {
        // let's create a location
        $location = factory(Location::class)->create();

        // also create a company
        $company = factory(Company::class)->create();

        // then create and add few models to company
        $models = factory(Model::class, 4)->create([
            'company_id' => $company->id
        ]);

        // now create a customer to which car is going to deliver
        $customer = factory(Customer::class)->create([
            'location_id' => $location->id
        ]);

        // request car delivery from location according to customer location
        $provider = ProviderService::deliverFrom($location)
            ->fromCompany($company)
            ->withModel($models->first()->title)
            ->toCustomer($customer);

        $delivery = $provider->makeDelivery();

        // finally we have a delivery with car delivered to customer
        $this->assertInstanceOf(Delivery::class, $delivery);

        // lastly make some assertions to ensures correctness
        $this->assertEquals(
            [
                'customer_id' => $customer->id,
                'location_id' => $customer->location->id,
            ],
            $delivery->only(['customer_id', 'location_id'])
        );
    }
}
