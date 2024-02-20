<?php

use Illuminate\Database\Seeder;
use App\Models\AbandonedCart;

class AbandonedCartSeeder extends Seeder
{
    public function run()
    {
        $abandoned_carts = factory(AbandonedCart::class)->times(50)->make()->each(function ($abandoned_cart, $index) {
            if ($index == 0) {
                // $abandoned_cart->field = 'value';
            }
        });

        AbandonedCart::insert($abandoned_carts->toArray());
    }

}

