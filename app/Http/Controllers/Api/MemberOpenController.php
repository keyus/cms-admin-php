<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 会员中心-申请开户
 */
class MemberOpenController extends Controller
{
    /**
     * 列表读取
     */
    function list(Request $request) {
        $request->validate([
            'createTime' => 'array',
            'status' => 'integer',
        ], [
            'createTime.array' => '参数错误',
            'status.integer' => '参数错误',
        ]);

        $name = $request->name;
        $username = $request->username;
        $status = $request->status;
        $createTime = $request->createTime;

        $member_open = DB::table('member_open')
            ->select();

        if ($name) {
            $member_open->where('name', $name);
        }
        if ($username) {
            $member_open->where('username', $username);
        }
        if (isset($status)) {
            $member_open->where('status', $status);
        }
        if ($createTime) {
            $member_open->whereBetween('createTime', $createTime);
        }
        return $member_open->orderBy('createTime', 'desc')->paginate(15);
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
        $res = DB::table('member_open')
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
                'name' => 'required',
                'username' => 'required|exists:member,username',
                'idCard' => 'required|regex:/^\d{15,17}[0-9a-zA-Z]$/',
                'status' => 'regex:/^[0-9]$/',
            ],
            [
                'name.required' => '姓名未填写',
                'username.required' => '会员账号未填写',
                'username.exists' => '找不到该会员账号',
                'idCard.required' => '身份证号码款填写',
                'idCard.regex' => '身份证号码错误',
                'status.regex' => '处理状态参数错误',
            ]
        );
        $name = $request->name;
        $idCard = $request->idCard;
        $username = $request->username;
        $status = $request->status;
        $platform = $request->platform;

        $img1 = $request->img1;
        $img2 = $request->img2;
        $img3 = $request->img3;
        $img4 = $request->img4;
        $bankImg1 = $request->bankImg1;
        $bankImg2 = $request->bankImg2;

        $values = [
            'name' => $name,
            'idCard' => $idCard,
            'username' => $username,
            'status' => $status,

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

        $res = DB::table('member_open')
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
                'status' => 'required|in: 1,2',
                'issue' => 'required_if:status,2',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'status.in' => '处理状态参数错误',
                'issue.required_if' => '请填写失败原因',
            ]
        );
        $id = $request->id;
        $find = Db::table('member_open')->where('id', $id)->first();
        if ($find->status != 0) {
            return response()->json(['message' => '操作失败'], 522);
        }

        $status = $request->status;
        $issue = $request->issue;
        $values = [
            'status' => $status,
            'updateTime' => date('y-m-d H:i:s'),
        ];
        if ($issue) {
            $values['issue'] = $issue;
        }
        $res = DB::table('member_open')
            ->where('id', $id)
            ->update($values);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
