<?php
namespace App\Services;

use App\Repositories\ImportRepository;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class ImportService
{
    /**
     * @var ImportRepository
     */
    private $importRepository;
    private $account_id;

    /**
     * ImportService constructor.
     */
    public function __construct(ImportRepository $importRepository)
    {
        $this->importRepository = $importRepository;
    }

    public function getAll($account)
    {
        $imports = DB::table('imports as i')
            ->where('i.account_id', $account)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return ($imports->isNotEmpty()) ? $imports : $imports;
    }

    public function newImport($module, $arquivo)
    {
        // Define o nome do arquivo com o UUID referente a Importação
        $name = Uuid::generate()->string;
        $ext  = $arquivo->extension();

        $nomeArquivo = "{$name}.{$ext}";
        $urlArquivo = 'imports/'.AccountId().'/'.$module;
        $upload = $arquivo->storeAs($urlArquivo, $nomeArquivo);

        if(!$upload ){
            return "Falha ao enviar o arquivo";
            //die("Falha ao enviar o arquivo");
        }else{
            $dados = array(
                'uuid'       => $name,
                'url'        => $urlArquivo.'/'.$nomeArquivo,
                'module'     => $module,
                'account_id' => AccountId(),
                'status'     => 'upload',
                'created_at' => Carbon::now(new DateTimeZone('America/Sao_Paulo')),
                'updated_at' => Carbon::now(new DateTimeZone('America/Sao_Paulo'))
            );

            $import = DB::table('imports')->insertGetId($dados);
            $dados['id'] = $import;
            return (object) $dados;
        }
    }
}