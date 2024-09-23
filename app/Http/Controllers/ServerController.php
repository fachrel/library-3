<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index(){
        return view(view: 'server.dashboard');
    }
}
