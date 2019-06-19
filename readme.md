## About Assessment

For assessment code please have a look at following directories:

- `app/Domain/*`
- `app/ProviderService.php`
- `app/Exceptions/ProviderServiceException.php`

Migrations:

- `database/migrations*`

- For feature test look here and this test also demonstrate the usage of service:
- `tests/Feature/DeliverCarsTest.php`

Unit tests:
- `database/factories` --> for tests
- `tests/Unit/*`

## Installation
- git clone https://github.com/AhmadWaleed/assessment.git
- cd in to assessment (cloned folder)
- add your db credentials in .env file
- run following commands:
```bash
* composer install
* php artisan key:generate
* php artisan migrate
```
- run tests `vendor/bin/phpunit`

## Usage

```php
$provider = ProviderService::deliverFrom($location)
    ->fromCompany($company) // ex: (ACURA)
    ->withModel($model) // ex: 2.3CL
    ->toCustomer($customer); // ex: John Wick
    
// there you have a delivey with following information (customer, car, location)
$delivery = $provider->makeDelivery();
```

## Extra Packages use

- **[DTO](https://github.com/spatie/data-transfer-object)**
- **[PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)**

## Note

I use eloquent for bussiness logic because the requirments wasn't so clear i tried my best to understand the requiremetns.
Also i didn't use excessive comment becuase i am not int favour of comments unless your code is not self explainatory.