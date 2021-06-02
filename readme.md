# About Assessment

## Download

download assessment file from [here](https://github.com/AhmadWaleed/assessment/raw/master/assesment.zip).

## Solution

For assessment code please have a look at following files and directories:

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
$ composer install
$ php artisan key:generate
$ cp .env.example .env
$ php artisan migrate
```
- run tests `vendor/bin/phpunit`

## Usage

```php
$provider = ProviderService::deliverFrom($location) // // ex: Alabama
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

I use eloquent for modeling business requirements and the requirements was not much clear so i tried my best to understand the requirements.
Also i did not use excessive comment because i am not in favour of comments unless your code is not self explanatory.
Test coverage is not 100 % but most of the code is covered.
