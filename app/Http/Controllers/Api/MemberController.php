<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 会员中心
 */
class MemberController extends Controller
{
    /**
     * 列表读取
     */
    function list(Request $request) {
        $username = $request->username;
        $member = DB::table('member')
            ->select('id', 'username', 'name', 'nickname', 'phone','email', 'level', 'createTime');
        if ($username) {
            $member->where('username', $username);
        }
        return $member->paginate(15);
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
        $res = DB::table('member')
            ->where('id', $id)
            ->delete();
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

    /**
     * 添加
     */
    public function add(Request $request)
    {
        $request->validate(
            [
                'username' => 'regex:/^[a-zA-Z0-9]{6,20}$/i|unique:member',
                'password' => 'regex:/^[a-zA-Z0-9]{8,20}$/i',
                'level' => 'required|regex:/^[0-3]$/i',
            ],
            [
                'username.regex' => '用户名为6-20位数字或字母组成',
                'username.unique' => '用户名已存在',
                'password.regex' => '密码为8-20位数字或字母组成',
                'level.required' => '会员等级未填写',
                'level.regex' => '会员等级参数错误',
            ]
        );
        $level = $request->level;
        $username = $request->username;
        $password = $request->password;
        $name = $request->name;
        $nickname = $request->nickname;
        $phone = $request->phone;
        $email = $request->email;
        $res = DB::table('member')
            ->insert([
                'username' => $username,
                'password' => md5($password),
                'name' => $name,
                'nickname' => $nickname,
                'phone' => $phone,
                'email' => $email,
                'level' => $level,
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
                'password' => 'regex:/^[a-zA-Z0-9]{8,20}$/i',
                'level' => 'required|regex:/^[0-3]$/i',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'password.regex' => '密码为8-20位数字或字母组成',
                'level.required' => '会员等级未填写',
                'level.regex' => '会员等级参数错误',
            ]
        );
        $id = $request->id;
        $level = $request->level;
        $password = $request->password;
        $name = $request->name;
        $nickname = $request->nickname;
        $phone = $request->phone;
        $email = $request->email;

        $values = [
            'name' => $name,
            'nickname' => $nickname,
            'phone' => $phone,
            'email' => $email,
            'level' => $level,
            'updateTime' => date('y-m-d H:i:s'),
        ];
        if ($password) {
            $values['password'] = md5($password);
        }
        $res = DB::table('member')
            ->where('id', $id)
            ->update($values);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
