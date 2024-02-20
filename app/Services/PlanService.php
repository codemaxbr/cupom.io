<?php


namespace App\Services;

use App\Models\Plan;
use App\Repositories\PlanRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class PlanService
{
    /**
     * @var PlanRepository
     */
    private $planRepository;
    private $account_id;

    /**
     * PlanService constructor.
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    protected function setAccount($id)
    {
        $this->account_id = $id;
    }

    public function getPlan($id)
    {
        return $this->planRepository->find($id);
    }

    public function getAll()
    {
        return Plan::all();
    }

    public function getPlans_byType($type_id)
    {
        return $this->planRepository->with('payment_cycle:id,name')->findWhere(['type_plan_id' => $type_id, 'account_id' => AccountId()]);
    }

    public function allPlans()
    {
        return Plan::with('payment_cycle:id,name')->withCount('subscriptions')->where(['account_id' => AccountId()])->paginate(20);
    }

    public function updatePlan($dados ,$id)
    {
        return DB::table('plans')->where('id' , $id)->update($dados);
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function createPlan($data)
    {
        return Plan::create($data);
    }
}