<?php
/**
 * Created by PhpStorm.
 * User: Lucas Maia
 * Date: 24/10/2018
 * Time: 23:11
 */
namespace App\Services;

use App\Models\Optional;
use App\Repositories\OptionalRepository;

class OptionalService
{
    /**
     * @var OptionalRepository
     */
    private $optionalRepository;

    /**
     * OptionalService constructor.
     */
    public function __construct(OptionalRepository $optionalRepository)
    {
        $this->optionalRepository = $optionalRepository;
    }

    public function getOptionals()
    {
        return Optional::with('payment_cycle:id,name')->withCount('subscriptions')->where(['account_id' => AccountId()])->paginate(20);
    }

    public function create($data)
    {
        return $this->optionalRepository->create($data);
    }
}