<?php

namespace App\Interfaces\V1\BankAccount;

use App\Models\BankAccount;
use App\Models\User;

interface BankAccountRepositoryInterface
{
    /**
     * BankAccountRepository
     * @param array $data
     * @param \App\Models\User $user
     * @return BankAccount
     */
    public function BankAccountRepository(array $data, User $user): BankAccount;
}
