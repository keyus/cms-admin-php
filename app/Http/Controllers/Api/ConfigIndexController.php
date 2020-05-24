<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 首页配置
 */
class ConfigIndexController extends Controller
{
    public function index(Request $request)
    {
        $config = DB::table('config_index')->find(1);
        return (array) $config;
    }
    public function edit(Request $request)
    {
        $request->validate(
            [
                'banner' => 'required|integer|max:10',
                'notice' => 'required|integer|max:10',
                'm_title' => 'required|max:20',
                'ad' => 'required|integer|max:10',
                'm1' => 'required|integer|max:10',
                'm2' => 'required|integer|max:10',
                'm3' => 'required|regex:/^[0-9]+,[0-9]+,[0-9]+$/i',
            ]
        );
        $row = request([
            'banner', 'notice', 'ad', 'm_title',
            'm1', 'm2', 'm3',
        ]);
        $row['updateTime'] = date('Y-m-d H:i:s');
        $res = DB::table('config_index')
            ->where('id', 1)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
