<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * 上传图片
     * 默认存放    /upload/images/$year
     * path ?     /upload/images/$path/$year
     */
    public function upload(Request $request)
    {
        $request->validate([
            'path' => 'regex:/^[a-z-0-9]{1,50}$/i', //图片存放目录名称 6-50位
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'image.required' => '参数错误',
            'image.image' => '不支持的文件类型',
            'image.mimes' => '不支持的图片类型',
            'image.max' => '图片大小不能超过2M',
            'path.regex' => '参数错误',
        ]);
        $image = $request->file('image');
        $path = $request->path;
        $year = date('Y');
        $file = time() . '.' . $image->getClientOriginalExtension();

        $dir = public_path('/upload/images/' . $year);
        $url = '/upload/images/' . $year . '/' . $file;
        if ($path) {
            $dir = public_path('/upload/images/' . $path . '/' . $year);
            $url = '/upload/images/' . $path . '/' . $year . '/' . $file;
        }

        $image->move($dir, $file);
        return response()->json(['data' => $url]);
    }
}
