<?php

use App\Services\ConfigService;
use Illuminate\Database\Seeder;

class TypesTermsSeeder extends Seeder
{
    /**
     * @var ConfigService
     */
    private $configService;

    /**
     * TypesTermsSeeder constructor.
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
        // Criar automaticamente os tipos de contrato [recorrente, gratuito, unico]
        $this->configService->createTypeTerm('Recorrente');
        $this->configService->createTypeTerm('Gratuito');
        $this->configService->createTypeTerm('Único');
    }
}
