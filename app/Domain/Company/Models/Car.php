<?php

namespace App\Domain\Company\Models;

use App\Domain\Shared\Models\BaseModel;
use App\Domain\Location\Models\Concern\HasLocation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
