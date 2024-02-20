<?php

use App\Services\ConfigService;
use Illuminate\Database\Seeder;

class TypesPlanSeeder extends Seeder
{
    /**
     * @var ConfigService
     */
    private $configService;

    /**
     * TypesPlanSeeder constructor.
     * @param ConfigService $configService
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
        //$this->configService->createTypePlan('Hospedagem de Sites');
        //$this->configService->createTypePlan('Revenda de Hospedagem');
        //$this->configService->createTypePlan('Streaming');
        //$this->configService->createTypePlan('Servidor Dedicado/VPS');
        //$this->configService->createTypePlan('Conteúdo por Assinatura');
        //$this->configService->createTypePlan('Licença de Software');
        //$this->configService->createTypePlan('Outros');
        $this->configService->createTypePlan('Produto');
        $this->configService->createTypePlan('Serviço');
        $this->configService->createTypePlan('Assinatura');
    }
}
