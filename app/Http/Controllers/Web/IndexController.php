<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $config = DB::table('config_index')->find(1);
        $value = [
            'banner' => null,
            'ad' => null,
            'notice' => null,
            'notice_channel' => null,
        ];
        //banner
        if ($config->banner) {
            $ad_banner = DB::table('ad')->where('show', 1)->find($config->banner);
            if ($ad_banner) {
                $ad_banner_content = DB::table('ad_content')->where('aid', $ad_banner->id)->first();
                if ($ad_banner_content) {
                    $value['banner'] = $ad_banner_content;
                }
            }
        }
        //广告4 x 4
        if ($config->ad) {
            $ad = DB::table('ad')->where('show', 1)->find($config->ad);
            if ($ad) {
                $ad_content = DB::table('ad_content')->where('aid', $ad->id)->limit(4)->get();
                if ($ad_content) {
                    $value['ad'] = $ad_content;
                }
            }
        }
        //公告位置模块
        if ($config->notice) {
            $notice_channel = DB::table('channel')->select('id','title','name')->where('show', 1)->find($config->notice);
            $notice = DB::table('article')->select('id','title','desc','createTime')->where('show', 1)->where('channelId',$config->notice)->limit(4)->get();
            $value['notice'] = $notice;
            $value['notice_channel'] = $notice_channel;
        }

        // dd($value);
        return view('index', $value);
    }
}
