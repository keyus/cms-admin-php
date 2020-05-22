<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 下载管理
 * 上传文件 存放   /upload/download/2020?   对应的年份
 */
class DownloadController extends Controller
{

    function list(Request $request) {
        $request->validate([
            'channelId' => 'integer',
        ], [
            'channelId.integer' => '参数错误',
        ]);
        $name = $request->name;
        $channelId = $request->channelId;
        $download = DB::table('download')
            ->select();
        if ($name) {
            $download->where('name', 'like', '%' . $name . '%');
        }
        if ($channelId) {
            $download->where('channelId', $channelId);
        }
        return $download->paginate(15);
    }

    /**
     * 删除单条记录
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

        $find = DB::table('download')
            ->where('id', $id)
            ->first();

        if ($find->file) {
            try {
                @unlink(public_path($find->file));
            } catch (ErrorException $e) {
            }
        }

        $res = DB::table('download')
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
                'channelId' => 'integer',
                'file' => 'mimes:jpg,gif,jpeg,png,rar,zip,tar.gz,doc,docx,xlsx,pdf,txt,apk,exe,dmg|max:102400',
            ],
            [
                'channelId.integer' => '参数错误',
                'file.mimes' => '不支持的文件格式',
            ]
        );
        $row = request(['name', 'channelId', 'img']);
        $file = $request->file('file');

        if ($file) {
            $ext = $file->getClientOriginalExtension();
            $name = time() . '.' . $ext;
            $year = date('Y');
            $path = public_path('/upload/download/' . $year);

            $row['size'] = $file->getClientSize();
            $row['filename'] = $file->getClientOriginalName();

            $row['file'] = '/upload/download/' . $year . '/' . $name;
            $row['ext'] = $ext;
            $file->move($path, $name);
        }
        $res = DB::table('download')
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
                'channelId' => 'nullable|integer',
                'file' => 'mimes:jpg,gif,jpeg,png,rar,zip,tar.gz,doc,docx,xlsx,pdf,txt,apk,exe,dmg|max:102400',
            ],
            [
                'id.required' => '参数错误',
                'id.integer' => '参数错误',
                'channelId.integer' => '参数错误',
                'file.mimes' => '不支持的文件格式',
            ]
        );
        $id = $request->id;
        $row = request(['name', 'channelId', 'img']);
        $row['updateTime'] = date('y-m-d H:i:s');
        $file = $request->file('file');

        $find = DB::table('download')->where('id', $id)->first();

        if ($file) {
            //删除老文件
            if ($find->file) {
                try {
                    @unlink(public_path($find->file));
                } catch (ErrorException $e) {
                }
            }

            $ext = $file->getClientOriginalExtension();
            $name = time() . '.' . $ext;
            $year = date('Y');
            $path = public_path('/upload/download/' . $year);

            $row['size'] = $file->getClientSize();
            $row['filename'] = $file->getClientOriginalName();

            $row['file'] = '/upload/download/' . $year . '/' . $name;
            $row['ext'] = $ext;
            $file->move($path, $name);
        }
        $res = DB::table('download')
            ->where('id', $id)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
