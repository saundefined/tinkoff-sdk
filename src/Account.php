<?php

namespace Tinkoff\Business;

use Tinkoff\Business\Model\AccountCollection;

class Account
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(): AccountCollection
    {
        $data = $this->client->query('accounts');

        $collection = new AccountCollection();
        if (!empty($data)) {
            foreach ($data as $item) {
                $model = Model\Account::createFromArray($item);

                $collection->add($model);
            }
        }

        return $collection;
    }
}
