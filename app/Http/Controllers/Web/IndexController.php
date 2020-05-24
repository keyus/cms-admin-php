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
            'notice_channel' => null,
            'notice' => null,
            'm1' => null,
            'm1_channel' => null,
            'm2' => null,
            'm3' => null,
            'm_title' => null,
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
        //网站公告模块
        if ($config->notice) {
            $notice_channel = DB::table('channel')->select('id', 'title', 'name')->where('show', 1)->find($config->notice);
            $notice = DB::table('article')->select('id', 'title', 'createTime')->where('show', 1)->where('channelId', $config->notice)->orderBy('createTime', 'desc')->first();
            $value['notice_channel'] = $notice_channel;
            $value['notice'] = $notice;
        }
        //m1模块 
        if ($config->m1) {
            $m1_channel = DB::table('channel')->select('id', 'title', 'title_show', 'name')->where('show', 1)->find($config->m1);
            $m1 = DB::table('article')->select('id', 'title', 'desc', 'createTime')->where('show', 1)->where('channelId', $config->m1)->limit(4)->get();
            $value['m1'] = $m1;
            $value['m1_channel'] = $m1_channel;
        }

        //m2模块
        if ($config->m2) {
            $m2 = DB::table('channel')->select('id', 'title', 'title_show', 'name', 'img', 'content_desc')->where('show', 1)->find($config->m2);
            $value['m2'] = $m2;
        }

        //标题文本配置
        if ($config->m_title) {
            $value['m_title'] = $config->m_title;
        }

        //m3，m4,m5模块
        if ($config->m3) {
            $m3_array = explode(',', $config->m3);
            $m3 = DB::table('channel')
                ->select('id', 'title', 'title_show', 'name')
                ->where('show', 1)
                ->whereIn('id', $m3_array)
                ->get();
            $first = DB::table('article')->select('id', 'title', 'channelId', 'img', 'createTime')->where('show', 1)->where('channelId', $m3_array[0])->limit(5);
            $second = DB::table('article')->select('id', 'title', 'channelId', 'img', 'createTime')->where('show', 1)->where('channelId', $m3_array[1])->limit(5);
            $three = DB::table('article')->select('id', 'title', 'channelId', 'img', 'createTime')->where('show', 1)->where('channelId', $m3_array[2])->limit(5);
            $article = $three->union($first)->union($second)->orderBy('createTime', 'desc')->get()->toArray();
            foreach($m3 as $it){
                $it->children = array_filter($article, function($val) use ($it){
                    return $val->channelId == $it->id;
                });
            };
            $value['m3'] = $m3;
        }
        return view('index', $value);
    }
}
