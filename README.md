# Tinkoff Business SDK

```php
<?php

use Tinkoff\Business\OAuth\Client;
use Tinkoff\Business\Model\Payment;
use Tinkoff\Business\Tinkoff;

// Получение access_token
$client = new Client('testclient', 'testpassword', 'https://my_tinkoff.ru');
$authorizeUrl = $client->getAuthorizeUrl();
$access_token = $client->withCode('122333')->getAccessToken();

$tinkoff = new Tinkoff('account_inn');
$tinkoff->setAccessToken($access_token);
$accounts = $tinkoff->getAccounts();

$reportList = $tinkoff->getAccount('40000000000000000000')->getOperations()->getArray();

$payment = new Payment();
$payment->setDocumentNumber('13');
$payment->setAmount(100);
$payment->setRecipientName('ООО Ромашка');
$payment->setInn('76000000000');
$payment->setKpp('7601001');
$payment->setAccountNumber('40000000000000000000');

$documentId = $tinkoff->sendPayment($payment);
```