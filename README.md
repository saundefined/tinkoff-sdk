# Unofficial Tinkoff Business SDK

[![CircleCI](https://circleci.com/gh/saundefined/tinkoff-sdk.svg?style=svg)](https://circleci.com/gh/saundefined/tinkoff-sdk)
[![Latest Stable Version](https://poser.pugx.org/saundefined/tinkoff/v/stable)](https://packagist.org/packages/saundefined/tinkoff)
[![Latest Unstable Version](https://poser.pugx.org/saundefined/tinkoff/v/unstable)](https://packagist.org/packages/saundefined/tinkoff)
[![codecov](https://codecov.io/gh/saundefined/tinkoff-sdk/branch/master/graph/badge.svg)](https://codecov.io/gh/saundefined/tinkoff-sdk)
[![Total Downloads](https://poser.pugx.org/saundefined/tinkoff/downloads)](https://packagist.org/packages/saundefined/tinkoff)
[![License](https://poser.pugx.org/saundefined/tinkoff/license)](https://packagist.org/packages/saundefined/tinkoff)

## Инициализация

Логин и пароль можно получить в личном кабинете [Тинькофф Бизнес](https://business.tinkoff.ru/)

## Получение токена
```php
<?php

$client = new Tinkoff\Business\OAuth\Client('client_id', 'client_secret', 'refresh_token');
$access_token = $client->renew()->getAccessToken();
```

## Примеры
