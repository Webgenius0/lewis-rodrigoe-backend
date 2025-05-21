<?php

namespace App\Interfaces\V1\BankAccount;

use App\Models\BankAccount;
use App\Models\User;

interface BankAccountRepositoryInterface
{
    /**
     * createBankAccount
     * @param array $data
     * @param \App\Models\User $user
     * @return BankAccount
     */
    public function createBankAccount(array $data, User $user): BankAccount;
}
