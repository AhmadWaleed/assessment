<?php

namespace App\Domain\Company\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\Customer\Models\Customer;
use App\Domain\Location\Models\Concern\HasLocation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends BaseModel
{
    use HasLocation;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
