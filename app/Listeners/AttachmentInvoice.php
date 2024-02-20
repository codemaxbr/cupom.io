<?php

namespace App\Listeners;

use App\Events\ConfirmPayment;
use App\Models\Invoice;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class AttachmentInvoice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     * @throws \Exception
     */
    public function handle(ConfirmPayment $event)
    {
        $user = $event->user;
        $invoice = $event->invoice;
        $request = $event->request;
        $uuid = Uuid::generate(4);

        $anexo = $request->file('comprovante');
        $imageFileName = 'comprovante_inv'.$invoice->id.'.'.$anexo->getClientOriginalExtension();

        $s3 = Storage::disk('s3');
        if(!$s3->exists('/uploads/anexos')){
            $s3->makeDirectory('/uploads/anexos/');
        }
        $filePath = '/uploads/anexos/'.$imageFileName;
        $s3->put($filePath, fopen($anexo, 'r+'), 'public');

        if($s3->exists($filePath)){
            $anexo = $invoice->attachments()->create([
                'name' => 'Comprovante de pagamento - Fatura #'.$invoice->id,
                'uuid' => Uuid::generate(4),
                'account_id' => $invoice->account_id,
                'file_url' => env('S3_URL').$filePath
            ]);
        }
    }
}
