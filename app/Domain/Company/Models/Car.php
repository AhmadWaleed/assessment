<?php

namespace App\Domain\Company\Models;

use App\Domain\Customer\Models\Customer;
use App\Domain\Shared\Models\BaseModel;
use App\Domain\Location\Models\Concern\HasLocation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends BaseModel
{
    use HasLocation;

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function Model(): BelongsTo
    {
        return $this->belongsTo(Model::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }


    public function deliverTo(Customer $customer)
    {
        return $this->deliveries()->create([
            'customer_id' => $customer->id,
            'location_id' => $customer->location->id,
        ]);
    }
}
