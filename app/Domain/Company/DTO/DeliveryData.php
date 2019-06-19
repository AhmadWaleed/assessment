<?php

namespace App\Domain\Company\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\ImmutableDataTransferObject;

class DeliveryData extends DataTransferObject
{
    /** @var \App\Domain\Customer\Models\Customer */
    public $customer;

    /** @var \App\Domain\State\Models\Location */
    public $location;

    /** @var string */
    public $model;

    public static function immutable(array $parameters): ImmutableDataTransferObject
    {
        foreach ($parameters as $key => $param) {
            if (in_array($param, [null, ''])) {
                throw new \InvalidArgumentException("{$key} propery cannot not be null or empty");
            }
        }

        return parent::immutable($parameters);
    }
}
