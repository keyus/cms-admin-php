<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 站点基本信息
 */
class SiteController extends Controller
{
    function list() {
        return (array) DB::table('site')->find(1);
    }

    /**
     * 编辑
     */
    public function edit(Request $request)
    {
        $row = request([
            'name', 'logo', 'net', 'seoTitle', 'seoKey', 'seoDesc', 'copyright', 'caseNumber',
            'phone', 'mobileLogo', 'pcCode', 'mobileCode', 'footer_title', 'footer_desc',
        ]);

        $res = DB::table('site')
            ->where('id', 1)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
