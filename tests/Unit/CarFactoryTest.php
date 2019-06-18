<?php

namespace Tests\Unit;

use App\Domain\Company\Factories\CarFactory;
use App\Domain\Company\Models\Car;
use App\Domain\Company\Models\Company;
use App\Domain\Company\Models\Model;
use App\Exceptions\ProviderServiceException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ensures_factory_can_car()
    {
        $company = factory(Company::class)->create();

        $models = factory(Model::class, 4)->create([
            'company_id' => $company->id
        ]);

        $car = (new CarFactory())($company, $models->first()->title);

        $this->assertInstanceOf(Car::class, $car);
    }

    /** @test */
    public function it_will_except_when_company_does_not_has_given_model()
    {
        $this->expectException(ProviderServiceException::class);

        $company = factory(Company::class)->create();

        (new CarFactory())($company, 'invalid-model');
    }
}
