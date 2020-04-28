<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * 广告名称列表
 */
class AdController extends Controller
{
    /**
     * 列表读取
     */
    function list(Request $request) {
        $name = $request->name;
        $ad = DB::table('ad');
        if ($username) {
            $admin->where('name', $name);
        }
        return $admin->paginate(15);
    }

    /**
     * 删除
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
        try{
            DB::transaction(function () {
                DB::table('ad')
                    ->where('id', $id)
                    ->delete();
                DB::table('ad_content')
                    ->where('aid', $id)
                    ->delete();
            });
            return response()->json(['data' => true]);
        }catch(Throwable $e){
            return response()->json(['message' => '操作失败'], 522);
        };
    }

    /**
     * 添加
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
                'password' => $password,
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
            $value['password'] = $password;
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
