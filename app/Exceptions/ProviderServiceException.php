<?php

namespace App\Exceptions;

class ProviderServiceException extends \Exception
{
    public static function locationMismatch()
    {
        return new static("Location does'nt match with Delivery location!");
    }

    public static function invalidCarModel(string $model, string $company)
    {
        return new static("Car Model: {$model} does'nt belogs to given company: {$company}");
    }
}
