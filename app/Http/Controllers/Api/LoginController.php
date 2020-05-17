<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * 登陆控制
 */
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = request(['username', 'password']);
        $token = auth('api')->attempt($user);
        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $username = request('username');
        $find = DB::table('admin')
            ->select('username', 'name','phone','role','lastLoginTime')
            ->where('username', $username)
            ->first();

        return response()->json([
            'token' => $token,
            'user'=> $find,
        ]);
    }
}
