<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 会员中心-资金记录
 */
class MemberMoneyController extends Controller
{
    /**
     * 列表读取
     */
    function list(Request $request) {
        $account = $request->account;
        $username = $request->username;
        $date = $request->date;
        $member_money = DB::table('member_money');
        if ($account) {
            $member_money->where('account', $account);
        }
        if ($username) {
            $member_money->where('username', $username);
        }
        if($date){
            // list($startDate, $endDate) = $date;
            $member_money->whereBetween('date', $date);
        }
        return $member_money->orderBy('date', 'desc')->paginate(15);
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
        $res = DB::table('member_money')
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
                'date' => 'required|date',
                'account' => 'required|exists:member_account,account',
                'username' => 'required|exists:member,username',
                'status' => 'required|boolean',
                'money' => 'required|regex:/^(-?\d+)(\.\d{1,2})?$/',
            ],
            [
                'date.required' => '资金记录日期未填写',
                'date.date' => '资金记录日期格式错误',
                'account.required' => '交易账号id参数错误',
                'account.exists' => '交易账号不存在',
                'username.required' => '会员账号未填写',
                'username.exists' => '会员账号不存在',
                'status.required' => '资金结算状态参数错误',
                'status.boolean' => '资金结算状态参数错误',
                'money.required' => '金额未填写',
                'money.regex' => '金额填写错误',
            ]
        );
        $date = $request->date;
        $account = $request->account;
        $username = $request->username;
        $money = $request->money;
        $status = $request->status;
        $res = DB::table('member_money')
            ->insert([
                'date' => $date,
                'account' => $account,
                'username' => $username,
                'money' => $money,
                'status' => $status,
            ]);
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
                'date' => 'required|date',
                'account' => 'required|exists:member_account,account',
                'username' => 'required|exists:member,username',
                'status' => 'required|boolean',
                'money' => 'required|regex:/^(-?\d+)(\.\d{1,2})?$/',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'date.required' => '资金记录日期未填写',
                'date.date' => '资金记录日期格式错误',
                'account.required' => '交易账号id参数错误',
                'account.exists' => '交易账号不存在',
                'username.required' => '会员账号未填写',
                'username.exists' => '会员账号不存在',
                'status.required' => '资金结算状态参数错误',
                'status.boolean' => '资金结算状态参数错误',
                'money.required' => '金额未填写',
                'money.regex' => '金额填写错误',
            ]
        );
        $id = $request->id;
        $date = $request->date;
        $account = $request->account;
        $username = $request->username;
        $money = $request->money;
        $status = $request->status;
        $res = DB::table('member_money')
            ->where('id', $id)
            ->update([
                'date' => $date,
                'account' => $account,
                'username' => $username,
                'money' => $money,
                'status' => $status,
            ]);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
