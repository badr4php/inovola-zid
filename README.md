## Description

(Inovola) Laravel Backend Assignment.
Features:
- Visitors can register/login either as merchants or end consumers.
- Merchants can set their store name
- Merchants can decide if the VAT is included in the products price or should be calculated
from the products price.
- Merchants can set VAT percentage in case the VAT isn’t included in the product’s price.
- Merchants can add products with multilingual names and descriptions and prices.
- Consumers can add products to their carts.
- Calculate the cart’s total considering these subtotals:
    - Cart’s products prices.
    - Store VAT settings.

## Notes:
 - For simplicity the app contains only two roles ('merchant', 'consumer') and user can only has one role.
 - The vat was calculated for each product not for cart total(Sorry, requirements misunderstanding )
 - Shipping cost was added to store but not calculated in cart total

## Installation
To avoid compatibility issues please use php 8.1
- `git clone`
- `composer install`
- set database credentials
- `php artisan migrate`
- `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`
- `php artisan jwt:secret`