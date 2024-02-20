<?php

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Module::create([
            'name' => 'Vindi',
            'slug' => 'vindi',
            'logo' => 'vindi.png',
            'description' => 'A Vindi é uma fintech de pagamentos on-line e soluções financeiras que ajuda empresas a venderem mais.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'PagSeguro UOL',
            'slug' => 'pagseguro',
            'logo' => 'pagseguro.png',
            'description' => 'O PagSeguro é o pioneiro e líder no mercado brasileiro de meios de pagamentos online. Pertencente ao UOL, empresa líder da internet brasileira.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'Moip',
            'slug' => 'moip',
            'logo' => 'moip.png',
            'description' => 'O Moip é uma solução de pagamentos multicanal. Cuidamos da segurança, dos contratos e de toda a burocracia para aceitar pagamentos online e também offline.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'PagHiper',
            'slug' => 'paghiper',
            'logo' => 'paghiper.png',
            'description' => 'A PagHiper é especializada em Boletos Online e Soluções de Pagamentos Digitais para Pessoas Físicas e Jurídicas com as menores taxas do mercado.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'PayPal',
            'slug' => 'paypal',
            'logo' => 'paypal.svg',
            'description' => 'Conheça o PayPal, uma forma segura de realizar compras e pagamentos online sem compartilhar os dados de seu cartão.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'Iugu',
            'slug' => 'iugu',
            'logo' => 'iugu.png',
            'description' => 'Conheça a iugu: primeira plataforma de automação de pagamentos online do Brasil. A iugu diminui as barreiras na implementação de pagamento digital.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'Gerencianet',
            'slug' => 'gerencianet',
            'logo' => 'gerencianet.png',
            'description' => 'Boletos e Recebimentos Online por cartão de crédito. Envio de boletos e carnês para seus clientes. Segurança nas transações.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'F2b',
            'slug' => 'f2b',
            'logo' => 'f2b.png',
            'description' => 'A F2b é uma empresa meios de pagamento eletrônicos pela Internet que oferece para pessoas físicas e jurídicas uma conta com serviços para cobrança online.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'Mercado Pago',
            'slug' => 'mercadopago',
            'logo' => 'mercadopago.png',
            'description' => 'Transforme a maneira como você paga, receba como quiser e não pare de vender. Consiga um empréstimo para impulsionar seus projetos.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'Pagar.me',
            'slug' => 'pagarme',
            'logo' => 'pagarme.png',
            'description' => 'O Pagar.me é uma solução de pagamentos online com a maior conversão de vendas do mercado. Receba pagamentos, fature mais e reduza seus custos.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'PagueVeloz',
            'slug' => 'pagueveloz',
            'logo' => 'pagueveloz.png',
            'description' => 'Boletos, cheques, contas, SMS, cartão. Você recebe de seus clientes e paga suas contas em um só lugar. Rápido, fácil e eficiente! Assim é o PagueVeloz.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'Yapay',
            'slug' => 'yapay',
            'logo' => 'yapay.svg',
            'description' => 'O Yapay é o meio mais seguro para recebimento de pagamentos online. Comprar e vender com a segurança de receber.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'MaxiPago',
            'slug' => 'maxipago',
            'logo' => 'maxipago.png',
            'description' => 'Gateway de Pagamentos da maxiPago!, diversos meios de pagamento e funcionalidades.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'Shopfacil',
            'slug' => 'shopfacil',
            'logo' => 'bradesco.png',
            'description' => 'Torne seu processo de vendas pela internet mais rápido, seguro e eficiente. Com os meios de pagamentos do Comércio Eletrônico Bradesco.',
            'type_module_id' => 3
        ]);

        \App\Models\Module::create([
            'name' => 'cPanel/WHM',
            'slug' => 'cpanel',
            'logo' => 'cpanel.png',
            'description' => 'Painel de controle baseado em Web que torna o gerenciamento de sites muito fácil. Ideal para empresas de hospedagem de sites.',
            'type_module_id' => 2
        ]);

        \App\Models\Module::create([
            'name' => 'WHMSonic',
            'slug' => 'whmsonic',
            'logo' => 'whmsonic.png',
            'description' => 'O painel WHMSonic é um sistema automatizado que lhe permitirá entre diversos outros recursos publicar de forma inteligente e rápida seu conteúdo.',
            'type_module_id' => 2
        ]);

        \App\Models\Module::create([
            'name' => 'Centova Cast',
            'slug' => 'centovacast',
            'logo' => 'centovacast.png',
            'description' => 'Gerencia uma única estação com facilidade, ou automatize e gerencie um negócio de rádio online com milhares de clientes. O Centova Cast pode gerenciar.',
            'type_module_id' => 2
        ]);

        \App\Models\Module::create([
            'name' => 'VestaCP',
            'slug' => 'vestacp',
            'logo' => 'vestacp.png',
            'description' => 'VestaCP é um painel de controle de hospedagem de código aberto. VestaCP fornece um conjunto de recursos para gerenciar domínios, DNS, Mail, bancos de dados e muito mais.',
            'type_module_id' => 2
        ]);

        \App\Models\Module::create([
            'name' => 'Plesk',
            'slug' => 'plesk',
            'logo' => 'plesk.png',
            'description' => 'O Plesk é o único painel de controle de hospedagem que você precisará para construir, proteger e executar sites e aplicativos na nuvem!',
            'type_module_id' => 2
        ]);
    }
}
