<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 内容页配置
 */
class ConfigContentController extends Controller
{
    public function index(Request $request)
    {
        $config = DB::table('config_content')->find(1);
        return (array) $config;
    }
    public function edit(Request $request)
    {
        $request->validate(
            [
                'link1_title' => 'required|max:10',
                'link2_title' => 'required|max:10',
                'link3_title' => 'required|max:10',
                'link1_url' => 'max:200',
                'link2_url' => 'max:200',
                'link3_url' => 'max:200',
                'link1_img' => 'max:200',
                'link2_img' => 'max:200',
                'link3_img' => 'max:200',
                'ad' => 'required|integer|max:10',
            ]
        );
        $row = request([
            'ad', 
            'link1_title','link1_url','link1_img',
            'link2_title','link2_url','link2_img',
            'link3_title','link3_url','link3_img',
        ]);
        $row['updateTime'] = date('Y-m-d H:i:s');
        $res = DB::table('config_content')
            ->where('id', 1)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
