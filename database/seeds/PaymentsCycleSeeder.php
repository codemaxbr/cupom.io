<?php

use App\Services\ConfigService;
use Illuminate\Database\Seeder;

class PaymentsCycleSeeder extends Seeder
{
    /**
     * @var ConfigService
     */
    private $configService;

    /**
     * PaymentsCycleSeeder constructor.
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
        $this->configService->createPaymentCycle('Único', '0');
        $this->configService->createPaymentCycle('Mensal', '1');
        $this->configService->createPaymentCycle('Trimestral', '3');
        $this->configService->createPaymentCycle('Semestral', '6');
        $this->configService->createPaymentCycle('Anual', '12');
        $this->configService->createPaymentCycle('Bienal', '24');
    }
}
