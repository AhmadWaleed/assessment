<?php

namespace App\Domain\Customer\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\Location\Models\Concern\HasLocation;

class Customer extends BaseModel
{
    use HasLocation;

    protected $casts = [
        'name' => 'string'
    ];
}
