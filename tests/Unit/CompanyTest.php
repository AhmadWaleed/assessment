<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Company\Models\Model;
use App\Domain\Company\Models\Company;
use App\Domain\Company\Factories\CarFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_models()
    {
        $company = factory(Company::class)->create();

        factory(Model::class, 4)->create([
            'company_id' => $company->id
        ]);

        $this->assertInstanceOf(Collection::class, $models = $company->models);
        $this->assertCount(4, $models);
    }

    /** @test */
    public function it_has_cars()
    {
        $company = factory(Company::class)->create();

        $model = factory(Model::class)->create([
            'company_id' => $company->id
        ]);

        (new CarFactory())($company, $model->first()->title);

        $this->assertInstanceOf(Collection::class, $cars = $company->cars);
        $this->assertCount(1, $cars);
    }

    /** @test */
    public function it_determines_if_company_has_some_model()
    {
        $company = factory(Company::class)->create();

        $model = factory(Model::class)->create([
            'company_id' => $company->id
        ]);

        $this->assertTrue($company->has($model->title));
        $this->assertFalse($company->has('non-existing'));
    }

    /** @test */
    public function it_can_get_model_by_title()
    {
        $company = factory(Company::class)->create();

        $model = factory(Model::class)->create([
            'company_id' => $company->id
        ]);

        $this->assertInstanceOf(Model::class, $company->getModel($model->title));
    }
}
