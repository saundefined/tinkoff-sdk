<?php

namespace Tinkoff\Business;

use Tinkoff\Business\Model\OperationCollection;

class Operation
{
    private $client;

    private $account;

    /**
     * Operation constructor.
     * @param Client $client
     * @param Model\Account $account
     */
    public function __construct(Client $client, Model\Account $account)
    {
        $this->client = $client;

        $this->account = $account;
    }

    public function get(): OperationCollection
    {
        $data = $this->client->query('excerpt', [
            'accountNumber' => $this->account->getAccountNumber()
        ]);

        $collection = new OperationCollection();
        if (!empty($data)) {
            foreach ($data['operation'] as $item) {
                $model = Model\Operation::createFromArray($item);

                $collection->add($model);
                echo '<pre style="color: red;">', print_r($model, true), '</pre>';
                die();
            }
        }

        return $collection;
    }
}
