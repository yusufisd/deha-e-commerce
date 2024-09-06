<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function profile()
    {
        $user = Http::get('https://dehapi.com/api/user/get')->json();
        dd($user);
    }

    
}
