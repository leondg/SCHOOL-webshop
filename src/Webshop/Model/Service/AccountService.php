<?php

namespace Webshop\Model\Service;

use Webshop\Model\Repository\AbstractRepository;
use Webshop\Model\Repository\AccountAddressRepository;
use Webshop\Model\Repository\AccountRepository;

class AccountService
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;
    /**
     * @var AccountAddressRepository
     */
    private $accountAddressRepository;

    public function __construct(AbstractRepository $accountRepository, AbstractRepository $accountAddressRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->accountAddressRepository = $accountAddressRepository;
    }

    public function getAccountDataByUsername($username)
    {
        $account = $this->accountRepository->findByUsername($username);
        $addresses = $this->accountAddressRepository->findByAccount($account->getId());

        return [
            'account' => $account,
            'addresses' => $addresses,
        ];
    }
}
