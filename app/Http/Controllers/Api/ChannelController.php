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
    function list(Request $request) {
        $request->validate([
            'model' => 'nullable|integer',
        ], [
            'model.in' => '参数错误',
        ]);
        $model = $request->model;
        $res = DB::table('channel')
            ->select('id', 'title', 'name', 'model', 'show', 'isNav', 'sort')
            ->orderBy('createTime', 'desc');
        if ($model) {
            $res->where('model', $model);
        }
        return $res->get();
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

        $find = DB::table('channel')
            ->where('id', $id)
            ->first();
        if ($find->file) {
            try {
                @unlink(public_path($find->img));
            } catch (ErrorException $e) {
            }
        }

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
                'name' => 'required|unique:channel',
                'sort' => 'integer',
            ],
            [
                'title.integer' => '栏目名称错误',
                'title.unique' => '栏目名称已存在',
                'sort.integer' => '排序不正确',
                'name.required' => '英文别名未填写',
                'name.unique' => '英文别名已经存在',
            ]
        );
        $row = request(['title', 'model', 'name']);
        if (isset($sort)) {
            $row['sort'] = $sort;
        }

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
                'title' => 'required|unique:channel,title,' . $request->id,
                'name' => 'required|unique:channel,name,' . $request->id,
                'template' => 'nullable|regex:/^[a-zA-Z][a-zA-Z0-9]{0,49}$/i',
                'aritcleTemplate' => 'nullable|regex:/^[a-zA-Z][a-zA-Z0-9]{0,49}$/i',
                'sort' => 'integer',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'title.unique' => '栏目名称已存在',
                'sort.integer' => '排序不正确',
                'name.required' => '英文别名未填写',
                'name.unique' => '英文别名已经存在',
                'template.regex' => '模板名称格式错误',
                'aritcleTemplate.regex' => '栏目内容模板名称格式错误',
            ]
        );
        $id = $request->id;
        $sort = $request->sort;
        $row = request([
            'title', 'model', 'show', 'isNav', 'img', 'name', 'seoTitle', 'seoKey', 'seoDesc',
            'content', 'template', 'aritcleTemplate',
        ]);
        $row['updateTime'] = date('y-m-d H:i:s');
        if (isset($sort)) {
            $row['sort'] = $sort;
        }

        $res = DB::table('channel')
            ->where('id', $id)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

}
