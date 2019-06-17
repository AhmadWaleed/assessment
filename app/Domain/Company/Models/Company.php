<?php

namespace App\Domain\Company\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends BaseModel
{
    protected $casts = [
        'value' => 'string',
        'name' => 'string',
        'title' => 'string',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(Model::class);
    }

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
