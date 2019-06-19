<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\State\Models\Location;
use App\Domain\Company\DTO\DeliveryData;
use App\Domain\Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\DataTransferObject\DataTransferObjectError;
use Spatie\DataTransferObject\ImmutableDataTransferObject;

class DeliveryDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_ensures_delivery_dto_is_instantiable()
    {
        $location = factory(Location::class)->create();

        $customer = factory(Customer::class)->create([
            'location_id' => $location->id
        ]);

        $dto = DeliveryData::immutable([
            'customer' => $customer,
            'location' => $location,
            'model' => 'A4'
        ]);

        $this->assertInstanceOf(ImmutableDataTransferObject::class, $dto);
        $this->assertInstanceOf(Customer::class, $dto->customer);
        $this->assertInstanceOf(Location::class, $dto->location);
        $this->assertEquals('A4', $dto->model);
    }

    /** @test */
    public function it_will_except_on_invalid_params()
    {
        $this->expectException(\InvalidArgumentException::class);

        $dto = DeliveryData::immutable([
            'customer' => null,
            'location' => '',
            'model' => ' '
        ]);
    }

    /** @test */
    public function it_ensures_dto_properties_are_immutable()
    {
        $this->expectException(DataTransferObjectError::class);

        $location = factory(Location::class)->create();

        $customer = factory(Customer::class)->create([
            'location_id' => $location->id
        ]);

        $dto = DeliveryData::immutable([
            'customer' => $customer,
            'location' => $location,
            'model' => 'A4'
        ]);

        $dto->customer = new \stdClass;
    }
}
