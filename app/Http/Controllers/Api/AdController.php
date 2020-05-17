<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 广告栏位
 */
class AdController extends Controller
{
    /**
     * 列表读取
     */
    function list(Request $request) {
        $name = $request->name;
        $ad = DB::table('ad');
        if ($name) {
            $ad->where('name', $name);
        }
        return $ad->orderBy('createTime','desc')->paginate(15);
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
        DB::table('ad_content')
            ->where('aid', $id)
            ->delete();
        DB::table('ad')
            ->where('id', $id)
            ->delete();
        return response()->json(['data' => true]);

    }

    /**
     * 添加
     */
    public function add(Request $request)
    {
        $request->validate(
            [
                'name' => 'unique:ad',
                'show' => 'boolean',
            ],
            [
                'name.unique' => '广告栏位名称已存在',
                'show.boolean' => '显示属性错误',
            ]
        );
        $value = request(['name', 'show', 'note',]);
        $res = DB::table('ad')
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
                'name' => 'unique:ad,name,' . $request->id,
                'show' => 'boolean',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'name.unique' => '广告栏位名称已存在',
                'show.boolean' => '显示属性错误',
            ]
        );
        $id = $request->id;
        $value = request(['name', 'show', 'note',]);
        $res = DB::table('ad')
            ->where('id', $id)
            ->update($value);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
