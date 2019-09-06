# Unofficial Tinkoff Business SDK

[![GitHub Actions](https://github.com/saundefined/tinkoff-sdk/workflows/Testing%20with%20PHPUnit/badge.svg)]
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

## Получение счетов пользователя

```php
<?php

$client = new Tinkoff\Business\Client('760000000000');
$client->setAccessToken('access_token');
    
$accounts = $client->accounts()->get();
$account = $accounts->current();
```

## Получение выписки по счету

```php
<?php

$client = new Tinkoff\Business\Client('760000000000');
$client->setAccessToken('access_token');

$accounts = $client->accounts()->get();
$account = $accounts->current();
    
$operations= $client->operations($account)->get();
```

## Создание платежного поручения

```php
<?php

$client = new Tinkoff\Business\Client('760000000000');
$client->setAccessToken('access_token');

$accounts = $client->accounts()->get();
$account = $accounts->current();
    
$payment = new Tinkoff\Business\Model\Payment();
$payment->setDocumentNumber('1');
$payment->setDate(new DateTime());
$payment->setAmount(100.0);

$recipient = new Tinkoff\Business\Model\Company();
$recipient->setName('ООО Ромашка');
$recipient->setInn('760000000000');
$recipient->setKpp('770000000');

$bank = new Tinkoff\Business\Model\Bank();
$bank->setAccountNumber('40101810900000000974');
$bank->setName('АО "ТИНЬКОФФ БАНК"');
$bank->setBic('044525974');
$recipient->setBank($bank);

$payment->setRecipient($recipient);
$payment->setPaymentPurpose('Тестовый платеж');
$payment->setExecutionOrder(5);
    
$document = $client->payment($account, $payment)->send();
```
