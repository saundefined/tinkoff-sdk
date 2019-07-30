<?php

namespace Tinkoff\Business;

use DateTime;
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

    /**
     * @param DateTime|null $from
     * @param DateTime|null $to
     *
     * @return OperationCollection
     *
     * @throws Exception\ApiException
     * @throws Exception\ArgumentException
     * @throws Exception\HttpException
     */
    public function get(?DateTime $from = null, ?DateTime $to = null): OperationCollection
    {
        $parameters = [
            'accountNumber' => $this->account->getAccountNumber(),
        ];

        if ($from) {
            $parameters['from'] = $from->format('Y-m-d\+H:i:s');
        }

        if ($to) {
            $parameters['till'] = $to->format('Y-m-d\+H:i:s');
        }

        $data = $this->client->query('excerpt', $parameters);

        $collection = new OperationCollection();
        if (!empty($data)) {
            foreach ($data['operation'] as $item) {
                $model = Model\Operation::createFromArray($item);

                $collection->add($model);
            }
        }

        return $collection;
    }
}
