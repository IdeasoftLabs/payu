## payu [![Build Status](https://travis-ci.org/IdeasoftLabs/payu.svg?branch=master)](https://travis-ci.org/IdeasoftLabs/payu)
PayU software development kit for PHP

### Installing payu
The easiest way to install payu is through composer.
```bash
composer require ideasoft/payu
```
## How to create token
Example file : create_token.php
```php
<?php

// request
$request = new CreateTokenRequest($param);
/** @var \IdeaSoft\PayU\Response\CreateTokenResponse $response */
$response = $request->send();
$token = $response->getTokenHash();