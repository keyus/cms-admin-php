<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 会员中心-交易账户
 */
class MemberAccountController extends Controller
{
    /**
     * 列表读取
     */
    function list(Request $request) {
        $account = $request->account;
        $username = $request->username;
        $member_account = DB::table('member_account')
            ->select();
        if ($account) {
            $member_account->where('account', $account);
        }
        if ($username) {
            $member_account->where('username', $username);
        }
        return $member_account->orderBy('createTime','desc')->paginate(15);
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
        $res = DB::table('member_account')
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
                'account' => 'required|unique:member_account',
                'username' => 'required|exists:member,username',
                'active' => 'required|boolean',
            ],
            [
                'account.required' => '交易账号未填写',
                'account.unique' => '交易账号已存在',
                'username.required' => '未绑定会员账号',
                'username.exists' => '会员账号不存在',
                'active.required' => '激活状态错误',
                'active.boolean' => '激活状态错误',
            ]
        );
        $account = $request->account;
        $username = $request->username;
        $name = $request->name;
        $active = $request->active;
        $idCard = $request->idCard;
        $platform = $request->platform;
        $img1 = $request->img1;
        $img2 = $request->img2;
        $img3 = $request->img3;
        $img4 = $request->img4;
        $bankImg1 = $request->bankImg1;
        $bankImg2 = $request->bankImg2;

        $values = [
            'account' => $account,
            'username' => $username,
            'name' => $name,
            'active' => $active,
            'idCard' => $idCard,
            'img1' => $img1,
            'img2' => $img2,
            'img3' => $img3,
            'img4' => $img4,
            'bankImg1' => $bankImg1,
            'bankImg2' => $bankImg2,
        ];
        if ($platform) {
            $values['platform'] = $platform;
        }

        $res = DB::table('member_account')
            ->insert($values);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

    /**
     * 编辑
     */
    public function edit(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|integer',
                'account' => 'unique:member_account,account,' . $request->id,
                'username' => 'required|exists:member,username',
                'active' => 'required|boolean',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'account.required' => '交易账号未填写',
                'account.unique' => '交易账号已存在',
                'username.required' => '未绑定会员账号',
                'username.exists' => '会员账号不存在',
                'active.required' => '激活状态错误',
                'active.boolean' => '激活状态错误',
            ]
        );
        $id = $request->id;
        $account = $request->account;
        $username = $request->username;
        $name = $request->name;
        $active = $request->active;
        $idCard = $request->idCard;
        $platform = $request->platform;
        $img1 = $request->img1;
        $img2 = $request->img2;
        $img3 = $request->img3;
        $img4 = $request->img4;
        $bankImg1 = $request->bankImg1;
        $bankImg2 = $request->bankImg2;

        $values = [
            'account' => $account,
            'username' => $username,
            'name' => $name,
            'active' => $active,
            'idCard' => $idCard,
            'img1' => $img1,
            'img2' => $img2,
            'img3' => $img3,
            'img4' => $img4,
            'bankImg1' => $bankImg1,
            'bankImg2' => $bankImg2,
            'updateTime' => date('y-m-d H:i:s'),
        ];
        if ($platform) {
            $values['platform'] = $platform;
        }

        $res = DB::table('member_account')
            ->where('id', $id)
            ->update($values);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
