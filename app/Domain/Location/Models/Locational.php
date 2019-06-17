<?php

namespace App\Domain\Location\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Locational extends Model
{
    public function locational(): MorphTo
    {
        return $this->morphTo();
    }
}
