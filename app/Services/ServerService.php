<?php

namespace App\Services;

use App\Models\Module;
use App\Models\Server;
use App\Repositories\ServerRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class ServerService
{
    /**
     * @var ServerRepository
     */
    private $serverRepository;
    private $account_id;

    /**
     * ServerService constructor.
     */
    public function __construct(ServerRepository $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    protected function setAccount($id)
    {
        $this->account_id = $id;
    }

    public function serversByModule(Module $module)
    {
        return $this->serverRepository->findWhere(['module_id' => $module->id, 'account_id' => AccountId()]);
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    public function createServer($data)
    {
        return Server::create($data);
    }

    public function allServers()
    {
        return Server::with('account')->paginate(10);
    }
}