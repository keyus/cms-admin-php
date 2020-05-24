<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 链接列表
 */
class LinksController extends Controller
{

    function list(Request $request) {
        $name = $request->name;
        $links = DB::table('links');
        if ($name) {
            $links->where('name', $name);
        }
        return $links->orderBy('createTime', 'desc')->paginate(15);
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

        $find = DB::table('links')
            ->where('id', $id)
            ->first();
        if ($find->img) {
            try {
                @unlink(public_path($find->img));
            } catch (ErrorException $e) {
            }
        }

        $res = DB::table('links')
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
                'type' => 'required|integer',
                'sort' => 'integer',
            ],
            [
                'name.required' => '网站名称必须填写',
            ]
        );
        $name = $request->name;
        $url = $request->url;
        $type = $request->type;
        $show = $request->show;
        $img = $request->img;
        $sort = $request->sort;
        $row = [
            'name' => $name,
            'url' => $url,
            'type' => $type,
            'show' => $show,
            'img' => $img,
        ];
        if (isset($sort)) {
            $row['sort'] = $sort;
        }

        $res = DB::table('links')
            ->insert($row);
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
                'name' => 'required',
                'type' => 'required|integer',
                'sort' => 'integer',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'name.required' => '网站名称必须填写',
            ]
        );
        $id = $request->id;
        $name = $request->name;
        $url = $request->url;
        $type = $request->type;
        $show = $request->show;
        $img = $request->img;
        $sort = $request->sort;
        $row = [
            'name' => $name,
            'url' => $url,
            'type' => $type,
            'show' => $show,
            'img' => $img,
            'updateTime' => date('y-m-d H:i:s'),
        ];
        if (isset($sort)) {
            $row['sort'] = $sort;
        }

        $res = DB::table('links')
            ->where('id', $id)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
