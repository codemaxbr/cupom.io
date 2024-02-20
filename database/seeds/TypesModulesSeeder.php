<?php

use App\Services\ConfigService;
use Illuminate\Database\Seeder;

class TypesModulesSeeder extends Seeder
{
    /**
     * @var ConfigService
     */
    private $configService;

    /**
     * TypesModulesSeeder constructor.
     */
    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Criar automaticamente os tipos de módulos [Helpdesk, Gateway de Pagamento, etc]
        $this->configService->createTypeModule('Adicional');
        $this->configService->createTypeModule('Painel de controle', 'panel');
        $this->configService->createTypeModule('Gateways de Pagamento', 'gateways');
        $this->configService->createTypeModule('Helpdesk');
    }
}
