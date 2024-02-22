<?php

namespace App\Http\Controllers;

use App\IpConfig;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getProfile(){
        return view('user.profile');
    }
    public function setIpAddress(Request $request){
        Log::error('Cập nhật ip');
        $user = User::where('id', Auth::id())->first();
        $user->ip = $request->ip;
        $user->save();
        $res = [
            'rc' => '0',
            'rd' => 'Cập nhật địa chỉ ip thành công',
            'user'=>$user
        ];
        return json_encode($res);
    }
}
