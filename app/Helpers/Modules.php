<?php

use App\Models\Option;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;

function moduleParams($module)
{
    $disk = Storage::disk('modules');
    if($disk->exists($module.'.xml')){
        $file = storage_path('modules/'.$module.'.xml');
        return simplexml_load_file($file);
    }else{
        return NULL;
    }
}

function getOption($name){

    $option = Option::query()->where(['account_id' => AccountId(), 'name' => $name])->get()->first();
    if(!is_null($option)){
        return $option->value;
    }else{
        return null;
    }
}

function valida_cartao($cartao, $cvc=false){
    $cartao = preg_replace("/[^0-9]/", "", $cartao);
    if($cvc) $cvc = preg_replace("/[^0-9]/", "", $cvc);

    $cartoes = array(
        'visa' => array('len' => array(13,16), 'cvc' => 3),
        'mastercard' => array('len' => array(16), 'cvc' => 3),
        'diners' => array('len' => array(14,16), 'cvc' => 3),
        'elo' => array('len' => array(16), 'cvc' => 3),
        'amex' => array('len' => array(15), 'cvc' => 4),
        'discover' => array('len' => array(16), 'cvc' => 4),
        'aura' => array('len' => array(16), 'cvc' => 3),
        'jcb' => array('len' => array(16), 'cvc' => 3),
        'hipercard'  => array('len' => array(13,16,19), 'cvc' => 3),
    );


    switch($cartao){
        case (bool) preg_match('/^(636368|438935|504175|451416|636297)/', $cartao) :
            $bandeira = 'elo';
            break;

        case (bool) preg_match('/^(606282)/', $cartao) :
            $bandeira = 'hipercard';
            break;

        case (bool) preg_match('/^(5067|4576|4011)/', $cartao) :
            $bandeira = 'elo';
            break;

        case (bool) preg_match('/^(3841)/', $cartao) :
            $bandeira = 'hipercard';
            break;

        case (bool) preg_match('/^(6011)/', $cartao) :
            $bandeira = 'discover';
            break;

        case (bool) preg_match('/^(622)/', $cartao) :
            $bandeira = 'discover';
            break;

        case (bool) preg_match('/^(301|305)/', $cartao) :
            $bandeira = 'diners';
            break;

        case (bool) preg_match('/^(34|37)/', $cartao) :
            $bandeira = 'amex';
            break;

        case (bool) preg_match('/^(36,38)/', $cartao) :
            $bandeira = 'diners';
            break;

        case (bool) preg_match('/^(64,65)/', $cartao) :
            $bandeira = 'discover';
            break;

        case (bool) preg_match('/^(50)/', $cartao) :
            $bandeira = 'aura';
            break;

        case (bool) preg_match('/^(35)/', $cartao) :
            $bandeira = 'jcb';
            break;

        case (bool) preg_match('/^(60)/', $cartao) :
            $bandeira = 'hipercard';
            break;

        case (bool) preg_match('/^(4)/', $cartao) :
            $bandeira = 'visa';
            break;

        case (bool) preg_match('/^(5)/', $cartao) :
            $bandeira = 'mastercard';
            break;
    }

    $dados_cartao = $cartoes[$bandeira];
    if(!is_array($dados_cartao)) return array(false, false, false);

    $valid     = true;
    $valid_cvc = false;

    if(!in_array(strlen($cartao), $dados_cartao['len'])) $valid = false;
    if($cvc AND strlen($cvc) <= $dados_cartao['cvc'] AND strlen($cvc) !=0) $valid_cvc = true;
    return array($bandeira, $valid, $valid_cvc);
}