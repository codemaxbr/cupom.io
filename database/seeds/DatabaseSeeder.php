<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ResellerSeeder::class,
            UsersSeeder::class,
            CustomerSeeder::class,
            TypesPlanSeeder::class,
            TypesTermsSeeder::class,
            TypesModulesSeeder::class,
            TypesPaymentSeeder::class,
            TypeInvoiceSeeder::class,
            TypesAddressSeeder::class,
            PaymentsCycleSeeder::class,
            TypesActivitiesSeeder::class,
            ModuleSeeder::class
        ]);
    }
}
