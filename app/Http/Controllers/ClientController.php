<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index () {
        $clients = Client::where('user_id', Auth::user()->id)->get();
        return view ('client', compact('clients'));
    }
}
