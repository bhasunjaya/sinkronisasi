<?php

namespace App\Http\Controllers\Pemda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsulanController extends Controller
{

    public function index(Request $request)
    {
        return view('pemda.usulan.index');
    }
}
