<?php

use Illuminate\Database\Seeder;

class TypeInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TypeInvoice::create(['name' => 'Avulsa']);
        \App\Models\TypeInvoice::create(['name' => 'Pedido']);
        \App\Models\TypeInvoice::create(['name' => 'Recorrência']);
        \App\Models\TypeInvoice::create(['name' => 'Pagamento']);
    }
}
