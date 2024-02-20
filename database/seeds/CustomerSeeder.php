<?php

use App\Services\CustomerService;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * CustomerSeeder constructor.
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('pt_BR');

        for ($i = 0; $i < 40; $i++)
        {
            $cliente = [
                'name' => $faker->name,
                'type' => 'fisica',
                'cpf_cnpj'  => Mask('###.###.###-##', randomNumber(11)),
                'email' => $faker->freeEmail,
                'phone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
                'birthdate' => $faker->date(),
                'account_id' => 1
            ];

            $this->customerService->newCustomer($cliente);
        }
    }
}
