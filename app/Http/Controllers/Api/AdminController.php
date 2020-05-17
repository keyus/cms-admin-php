<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * 管理员列表读取
     */
    function list(Request $request) {
        $username = $request->username;
        $admin = DB::table('admin')
            ->select('id', 'username', 'name', 'role', 'phone', 'lastLoginTime');
        if ($username) {
            $admin->where('username', $username);
        }
        return $admin->paginate(15);
    }

    /**
     * 删除管理员
     */
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ], [
            'id.required' => '参数错误',
            'id.integer' => '参数错误',
        ]);

        $id = $request->id;
        if ($id == 1) {
            return response()->json(['message' => '无权操作'], 403);
        }
        $res = DB::table('admin')
            ->where('id', $id)
            ->delete();

        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

    /**
     * 添加管理员
     */
    public function add(Request $request)
    {
        $request->validate(
            [
                'username' => 'regex:/^[a-zA-Z0-9]{4,20}$/i|unique:admin',
                'password' => 'regex:/^[a-zA-Z0-9]{4,20}$/i',
            ],
            [
                'username.regex' => '用户名为4-20位数字或字母组成',
                'username.unique' => '用户名已存在',
                'password.regex' => '密码为4-20位数字或字母组成',
            ]
        );
        $username = $request->username;
        $password = $request->password;
        $name = $request->name;
        $phone = $request->phone;
        
        $res = DB::table('admin')
            ->insert([
                'username' => $username,
                'password' => bcrypt($password),
                'name' => $name,
                'phone' => $phone,
            ]);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

    /**
     * 编辑管理员
     */
    public function edit(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|integer',
                'password' => 'regex:/^[a-zA-Z0-9]{4,20}$/i',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'password.regex' => '密码为4-20位数字或字母组成',
            ]
        );
        $id = $request->id;
        $password = $request->password;
        $name = $request->name;
        $phone = $request->phone;
        $value = [
            'name' => $name,
            'phone' => $phone,
            'updateTime' => date('y-m-d H:i:s'),
        ];
        if ($password) {
            $value['password'] = md5($password);
        }
        $res = DB::table('admin')
            ->where('id', $id)
            ->update($value);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
