<?php

use App\Models\Reseller;
use Illuminate\Database\Seeder;

class ResellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reseller::create([
            'name' => 'Root',
            'email' => 'lucas.codemax@gmail.com',
            'type' => 'juridica',
            'status' => 1,
            'confirmed' => 1,
        ]);
    }
}
