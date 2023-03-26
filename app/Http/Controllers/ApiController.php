<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');

        $exsists = Auth::attempt($credentials);
     
        echo json_encode($exsists);
    }
}
