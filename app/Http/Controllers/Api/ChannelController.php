<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChannelController extends Controller
{
    /**
     * 栏目列表
     */
    function list() {
        return DB::table('channel')
            ->select('id', 'title', 'model', 'show', 'sort')
            ->orderBy('createTime','desc')
            ->get();
    }

    /**
     * 获取一个栏目内容
     */
    public function get(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ], [
            'id.required' => '参数错误',
            'id.integer' => '参数错误',
        ]);
        $id = $request->id;
        $res = DB::table('channel')
            ->where('id', $id)
            ->first();
        return (array) $res;
    }

    /**
     * 删除栏目
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
        $res = DB::table('channel')
            ->where('id', $id)
            ->delete();
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

    /**
     * 添加栏目
     */
    public function add(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|unique:channel',
                'sort' => 'integer',
            ],
            [
                'title.integer' => '栏目名称错误',
                'title.unique' => '栏目名称已存在',
                'sort.integer' => '排序不正确',
            ]
        );
        $title = $request->title;
        $model = $request->model;
        $sort = $request->sort;
        $show = $request->show;
        $row = [
            'title' => $title,
            'model' => $model,
            'show' => $show,
        ];
        if($sort) $row['sort'] = $sort;

        $res = DB::table('channel')
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
                'title' => 'required|unique:channel,title,'.$request->id,
                'name' => 'unique:channel,name,'.$request->id,
                'sort' => 'integer',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'title.unique' => '栏目名称已存在',
                'sort.integer' => '排序不正确',
                'name.unique' => '英文别名已经存在',
            ]
        );
        $id = $request->id;
        $title = $request->title;
        $model = $request->model;
        $sort = $request->sort;
        $show = $request->show;

        $name = $request->name;
        $img = $request->img;
        $seoTitle = $request->seoTitle;
        $seoKey = $request->seoKey;
        $seoDesc = $request->seoDesc;

        $content = $request->content;

        $row = [
            'title' => $title,
            'model' => $model,
            'show' => $show,
            'img' => $img,
            'name' => $name,
            'seoTitle' => $seoTitle,
            'seoKey' => $seoKey,
            'seoDesc' => $seoDesc,
            'content' => $content,
            'updateTime' => date('y-m-d H:i:s'),
        ];
        if($sort) $row['sort'] = $sort;

        $res = DB::table('channel')
            ->where('id', $id)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

}
