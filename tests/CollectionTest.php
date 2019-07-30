<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Tinkoff\Business\Exception\OutOfRangeException;
use Tinkoff\Business\Model\Account;
use Tinkoff\Business\Model\AccountCollection;

final class CollectionTest extends TestCase
{
    public function testShouldAddAccount(): void
    {
        $collection = new AccountCollection();
        $this->assertSame(0, $collection->count());

        $account = new Account();
        $account->setAccountNumber('4080281000000000000');
        $account->setStatus('NORM');
        $account->setName('РУБЛЕВЫЙ СЧЕТ');
        $account->setCurrency(643);
        $collection->add($account);

        $this->assertSame(1, $collection->count());
    }

    public function testShouldClearCollection(): void
    {
        $collection = new AccountCollection();

        $account = new Account();
        $account->setAccountNumber('4080281000000000000');
        $account->setStatus('NORM');
        $account->setName('РУБЛЕВЫЙ СЧЕТ');
        $account->setCurrency(643);
        $collection->add($account);

        $this->assertSame(1, $collection->count());

        $collection->clear();

        $this->assertSame(0, $collection->count());
    }

    public function testShouldFindCollectionItem(): void
    {
        $collection = new AccountCollection();

        $account = new Account();
        $account->setAccountNumber('4080281000000000000');
        $account->setStatus('NORM');
        $account->setName('РУБЛЕВЫЙ СЧЕТ');
        $account->setCurrency(643);
        $collection->add($account);

        $account = new Account();
        $account->setAccountNumber('4080281000000000001');
        $account->setStatus('NORM');
        $account->setName('ДОЛЛАРОВЫЙ СЧЕТ');
        $account->setCurrency(840);
        $collection->add($account);

        $this->assertSame(2, $collection->count());

        $item = $collection->find(static function ($account) {
            return $account->getAccountNumber() === '4080281000000000001';
        });

        $this->assertSame('4080281000000000001', $item->getAccountNumber());
        $this->assertSame(840, $item->getCurrency());
    }

    public function testShouldNotFindCollectionItem(): void
    {
        $collection = new AccountCollection();

        $account = new Account();
        $account->setAccountNumber('4080281000000000000');
        $account->setStatus('NORM');
        $account->setName('РУБЛЕВЫЙ СЧЕТ');
        $account->setCurrency(643);
        $collection->add($account);

        $this->assertSame(1, $collection->count());

        $this->expectException(OutOfRangeException::class);

        $collection->find(static function ($account) {
            return $account->getAccountNumber() === '4080281000000000001';
        });
    }

    public function testShouldFindCollectionItemAtIndex(): void
    {
        $collection = new AccountCollection();

        $account = new Account();
        $account->setAccountNumber('4080281000000000000');
        $account->setStatus('NORM');
        $account->setName('РУБЛЕВЫЙ СЧЕТ');
        $account->setCurrency(643);
        $collection->add($account);

        $account = new Account();
        $account->setAccountNumber('4080281000000000001');
        $account->setStatus('NORM');
        $account->setName('ДОЛЛАРОВЫЙ СЧЕТ');
        $account->setCurrency(840);
        $collection->add($account);

        $this->assertSame(2, $collection->count());

        $item = $collection->at(1);

        $this->assertSame('4080281000000000001', $item->getAccountNumber());
    }

    public function testShouldNotFindCollectionItemAtIndex(): void
    {
        $collection = new AccountCollection();

        $account = new Account();
        $account->setAccountNumber('4080281000000000000');
        $account->setStatus('NORM');
        $account->setName('РУБЛЕВЫЙ СЧЕТ');
        $account->setCurrency(643);
        $collection->add($account);

        $this->assertSame(1, $collection->count());

        $this->expectException(OutOfRangeException::class);

        $collection->at(1);
    }

    public function testShouldReturnCurrentAccount(): void
    {
        $collection = new AccountCollection();

        $account = new Account();
        $account->setAccountNumber('4080281000000000000');
        $account->setStatus('NORM');
        $account->setName('РУБЛЕВЫЙ СЧЕТ');
        $account->setCurrency(643);
        $collection->add($account);

        $account = new Account();
        $account->setAccountNumber('4080281000000000001');
        $account->setStatus('NORM');
        $account->setName('ДОЛЛАРОВЫЙ СЧЕТ');
        $account->setCurrency(840);
        $collection->add($account);

        $this->assertSame(2, $collection->count());

        $item = $collection->current();

        $this->assertSame('4080281000000000000', $item->getAccountNumber());
    }

}
