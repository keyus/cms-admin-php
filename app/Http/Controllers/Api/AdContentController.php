<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 广告内容
 */
class AdContentController extends Controller
{
    /**
     * 列表读取
     */
    function list(Request $request) {
        $request->validate([
            'aid' => 'required|integer',
        ], [
            'aid.required' => '参数错误',
            'aid.integer' => '参数错误',
        ]);
        $aid = $request->aid;
        return DB::table('ad_content')
            ->where('aid', $aid)
            ->orderBy('createTime', 'desc')->get();
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
        $res = DB::table('ad_content')
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
                'aid' => 'required|integer',
                'img' => 'required',
                'isTarget' => 'boolean',
            ],
            [
                'aid.required' => '广告栏位id不存在',
                'aid.integer' => '广告栏位id错误',
                'img.required' => '图片不存在',
                'isTarget.boolean' => '参数错误',
            ]
        );
        $img = $request->img;
        $aid = $request->aid;
        $title = $request->title;
        $url = $request->url;
        $isTarget = $request->isTarget;
        $value = [
            'img' => $img,
            'aid' => $aid,
            'title' => $title,
            'url' => $url,
            'isTarget' => $isTarget,
        ];
        $res = DB::table('ad_content')
            ->insert($value);
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
                'aid' => 'required|integer',
                'img'=> 'required',
                'isTarget' => 'boolean',
            ],
            [
                'aid.required' => '广告栏位id不存在',
                'aid.integer' => '广告栏位id错误',
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'img.required' => '图片不存在',
                'isTarget.boolean' => '参数错误',
            ]
        );
        $id = $request->id;
        $img = $request->img;
        $aid = $request->aid;
        $title = $request->title;
        $url = $request->url;
        $isTarget = $request->isTarget;
        $value = [
            'img' => $img,
            'aid' => $aid,
            'title' => $title,
            'url' => $url,
            'isTarget' => $isTarget,
        ];
        $res = DB::table('ad_content')
            ->where('id', $id)
            ->update($value);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
