<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{

    /**
     * ConfigController constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        return view('config.index');
    }
}
