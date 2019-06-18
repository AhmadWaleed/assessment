<?php

namespace App\Domain\Location\Models\Concern;

use App\Domain\State\Models\Location;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasLocation
{
    public function location(): morphOne
    {
        return $this->morphOne(Location::class, 'locational');
    }

    public function state(): string
    {
        return $this->location->name;
    }
}