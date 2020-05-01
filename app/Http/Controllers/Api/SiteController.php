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
        return (array) DB::table('site')->where('id', 1)->first();
    }

    /**
     * 编辑
     */
    public function edit(Request $request)
    {
        $name = $request->name;
        $logo = $request->logo;
        $net = $request->net;
        $seoTitle = $request->indexTitle;
        $seoKey = $request->seoKey;
        $seoDesc = $request->seoDesc;
        $copyright = $request->copyright;
        $caseNumber = $request->caseNumber;
        $phone = $request->phone;
        $mobileLogo = $request->mobileLogo;
        $pcCode = $request->pcCode;
        $mobileCode = $request->mobileCode;
        $value = [
            'name' => $name,
            'logo' => $logo,
            'net' => $net,
            'seoTitle' => $seoTitle,
            'seoKey' => $seoKey,
            'seoDesc' => $seoDesc,
            'copyright' => $copyright,
            'caseNumber' => $caseNumber,
            'phone' => $phone,
            'mobileLogo' => $mobileLogo,
            'pcCode' => $pcCode,
            'mobileCode' => $mobileCode,
        ];
        $res = DB::table('site')
            ->where('id', 1)
            ->update($value);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
