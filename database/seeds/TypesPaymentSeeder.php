<?php

use Illuminate\Database\Seeder;

class TypesPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TypePayment::create(['name' => 'Boleto', 'slug' => str_slug('Boleto')]);
        \App\Models\TypePayment::create(['name' => 'Cartão de Crédito', 'slug' => str_slug('Cartão de Crédito')]);
        \App\Models\TypePayment::create(['name' => 'Transferência Bancária', 'slug' => str_slug('Transferência Bancária')]);
        \App\Models\TypePayment::create(['name' => 'Dinheiro', 'slug' => str_slug('Dinheiro')]);
        \App\Models\TypePayment::create(['name' => 'Débito Automático', 'slug' => str_slug('Débito Automático')]);
        \App\Models\TypePayment::create(['name' => 'Paypal', 'slug' => str_slug('Paypal')]);
    }
}
