<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * 上传图片
     */
    public function upload(Request $request)
    {
        $request->validate([
            'path' => 'regex:/^[a-z-0-9]{1,20}$/i',      //图片存放目录名称 6-20位
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'image.required' => '参数错误',
            'image.image' => '不支持的文件类型',
            'image.mimes' => '不支持的图片类型',
            'image.max' => '图片大小不能超过2M',
            'path.regex' => '参数错误',
        ]);
        $image = $request->file('image');
        $file = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/upload/images');
        $image->move($path, $file);
        return response()->json(['data'=> '/upload/images/'.$file]);
    }
}
