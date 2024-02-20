<?php

use App\Services\ConfigService;
use Illuminate\Database\Seeder;

class TypesAddressSeeder extends Seeder
{
    /**
     * @var ConfigService
     */
    private $configService;

    /**
     * TypesAddressSeeder constructor.
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
        $this->configService->createTypeAddress('Residencial');
        $this->configService->createTypeAddress('Comercial');
        $this->configService->createTypeAddress('Entrega');
    }
}
