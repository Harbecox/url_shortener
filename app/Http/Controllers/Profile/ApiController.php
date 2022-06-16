<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    function index(){
        $data['token'] = Auth::user()->api_token;
        return view("profile.api.index",$data);
    }
}
