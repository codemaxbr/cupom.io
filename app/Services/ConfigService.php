<?php
/**
 * Created by PhpStorm.
 * User: Lucas e Nathalia
 * Date: 09/07/2018
 * Time: 22:17
 */

namespace App\Services;


use App\Models\Bank;
use App\Models\Option;
use App\Models\TypeInvoice;
use App\Models\TypeModule;
use App\Models\TypePayment;
use App\Models\TypePlan;
use App\Repositories\PlanRepository;
use Illuminate\Support\Facades\DB;

class ConfigService
{
    /**
     * ConfigService constructor.
     */
    public function __construct()
    {

    }

    public function saveOption($data)
    {
        $option = $this->getOption($data['name']);

        if(!is_null($option)){
            return $option->where('name', $data['name'])->update(['value' => $data['value']]);
        }else{
            $data['account_id'] = AccountId();
            return Option::create($data);
        }
    }

    public function getOptions()
    {
        try{
            return Option::query()->where(['account_id' => AccountId()])->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getOption($name)
    {
        try{
            return Option::query()->find(['account_id' => AccountId(), 'name' => $name])->first();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getBanks()
    {
        try{
            return Bank::query()->where(['account_id' => AccountId()])->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function newBank($data)
    {
        try{
            return Bank::create($data);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getTypePayments()
    {
        try{
            return TypePayment::query()->orderBy('name', 'ASC')->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getPaymentsCycles()
    {
        try{
            return DB::table('payment_cycles')->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function createPaymentCycle($name, $months)
    {
        try{
            return DB::table('payment_cycles')->insert([
                'name' => $name,
                'slug' => str_slug($name),
                'months' => $months
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updatePaymentCycle($id, $name, $months)
    {
        try{
            return DB::table('payment_cycles')->where('id', $id)->update([
                'name' => $name,
                'slug' => str_slug($name),
                'months' => $months
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function deletePaymentCycle($id)
    {
        try{
            return DB::table('payment_cycles')->where('id', $id)->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getTypesPlan()
    {
        try{
            return TypePlan::all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getTypesInvoice()
    {
        try{
            return TypeInvoice::query()->orderBy('name', 'ASC')->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function createTypePlan($name)
    {
        try{
            return DB::table('type_plans')->insert([
                'name' => $name,
                'slug' => str_slug($name)
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateTypePlan($id, $name)
    {
        try{
            return DB::table('type_plans')->where('id', $id)->update([
                'name' => $name,
                'slug' => str_slug($name)
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteTypePlan($id)
    {
        try{
            return DB::table('type_plans')->where('id', $id)->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getTypesTerm()
    {
        try{
            return DB::table('type_terms')->orderBy('name', 'asc')->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function createTypeTerm($name)
    {
        try{
            return DB::table('type_terms')->insert([
                'name' => $name
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateTypeTerm($id, $name)
    {
        try{
            return DB::table('type_terms')->where('id', $id)->update([
                'name' => $name
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteTypeTerm($id)
    {
        try{
            return DB::table('type_terms')->where('id', $id)->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getTypesModules()
    {
        try{
            return TypeModule::with(['modules', 'modules.accounts'])->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function createTypeModule($name, $slug = null)
    {
        try{
            return DB::table('type_modules')->insert([
                'name' => $name,
                'slug' => (!is_null($slug)) ? $slug : str_slug($name)
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateTypeModule($id, $name)
    {
        try{
            return DB::table('type_modules')->where('id', $id)->update([
                'name' => $name
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return int|string
     */
    public function deleteTypeModule($id)
    {
        try{
            return DB::table('type_modules')->where('id', $id)->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function createTypeItem($name)
    {
        try{
            return DB::table('type_invoice_items')->insert(['name' => $name]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateTypeItem($id, $name)
    {
        try{
            return DB::table('type_invoice_items')->where('id', $id)->update([
                'name' => $name
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteTypeItem($id)
    {
        try{
            return DB::table('type_invoice_items')->where('id', $id)->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getTypesItem()
    {
        try{
            return DB::table('type_invoice_items')->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function createTypeAddress($name)
    {
        try{
            return DB::table('type_addresses')->insert([
                'name' => $name,
                'slug' => str_slug($name)
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function updateTypeAddress($id, $name)
    {
        try{
            return DB::table('type_addresses')->where('id', $id)->update([
                'name' => $name,
                'slug' => str_slug($name)
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function deleteTypeAddress($id)
    {
        try{
            return DB::table('type_addresses')->where('id', $id)->delete();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }

    public function getTypesAddress()
    {
        try{
            return DB::table('type_addresses')->get()->all();
        }catch (\Exception $e){
            return $e->getMessage();
        }
    }
}