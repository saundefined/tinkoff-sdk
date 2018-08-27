# Tinkoff Business SDK

```php
<?php

$tinkoff = new \Tinkoff\Business\Tinkoff('account_inn');
$tinkoff->setAccessToken('account_access_token');
$accounts = $tinkoff->getAccounts();

```