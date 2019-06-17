<?php

namespace App\Domain\Company\Models;

use App\Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Model extends BaseModel
{
    protected $casts = [
        'value' => 'string',
        'title' => 'string'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
