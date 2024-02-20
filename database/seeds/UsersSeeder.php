<?php

use App\Models\Reseller;
use App\Models\User;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * @var AccountService
     */
    private $accountService;

    /**
     * UsersSeeder constructor.
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acc = [
            'name_business' => 'Empresa Teste',
            'domain' => 'demo',
            'email_contact' => 'demo@gerentepro.com.br',
            'uuid' => Uuid::generate()->string,
            'status' => 1,
            'reseller_id' => 1,
        ];

        $account = $this->accountService->newAccount($acc);

        User::create([
            'name' => 'Demonstração',
            'email' => 'lucas.codemax@gmail.com',
            'password' => bcrypt('himura08'),
            'account_id' => $account,
            'confirmed' => 1
        ]);
    }
}
