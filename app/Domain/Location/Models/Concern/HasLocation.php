<?php

namespace App\Domain\Location\Models\Concern;

use App\Domain\State\Models\Location;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasLocation
{
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function state(): string
    {
        return $this->location->name;
    }
}
