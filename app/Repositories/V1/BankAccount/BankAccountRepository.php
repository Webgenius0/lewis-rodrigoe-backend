<?php

namespace App\Repositories\V1\BankAccount;

use App\Interfaces\V1\BankAccount\BankAccountRepositoryInterface;
use App\Models\BankAccount;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class BankAccountRepository implements BankAccountRepositoryInterface
{
    /**
     * createBankAccount
     * @param array $data
     * @param \App\Models\User $user
     * @return BankAccount
     */
    public function createBankAccount(array $data, User $user): BankAccount
    {
        try {
            return $user->backAccount()->create([
                'name'           => $data['bank_accounts_name'],
                'number'         => $data['bank_accounts_number'],
                'bank_name'      => $data['bank_accounts_bank_name'],
                'branch'         => $data['bank_accounts_branch'],
                'routing_number' => $data['bank_accounts_routing_number'],
                'country'        => $data['bank_accounts_country'],
                'state'          => $data['bank_accounts_state'],
                'city'           => $data['bank_accounts_city'],
            ]);
        } catch (Exception $e) {
            Log::error('BankAccountRepository::createBankAccount', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}
