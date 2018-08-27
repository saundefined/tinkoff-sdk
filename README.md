# Tinkoff Business SDK

```php
<?php

$tinkoff = new \Tinkoff\Business\Tinkoff('account_inn');
$tinkoff->setAccessToken('account_access_token');
$accounts = $tinkoff->getAccounts();

$reportList = $tinkoff->getAccount('40000000000000000000')->getOperations()->getArray();

```