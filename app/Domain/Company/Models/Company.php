<?php

namespace App\Domain\Company\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends BaseModel
{
    protected $casts = [
        'value' => 'string',
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

    public function has(string $model): bool
    {
        return $this->models()->whereTitle($model)->exists();
    }

    public function getModel(string $model): Model
    {
        return $this->models()->whereTitle($model)->first();
    }
}
