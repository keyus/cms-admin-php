<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * model : 0文章列表   1单页  2下载
 * template:  0  channel    1 single     2  download
 */
class ChannelController extends Controller
{

    protected $list_model = 0;
    protected $download_model = 2;
    protected $template = [
        0 => 'list',
        1 => 'detail',
        2 => 'download',
    ];
    public function index(Request $request, $name)
    {
        $channel = DB::table('channel')->where('name', $name)->first();
        $model = $channel->model;

        //确认使用模板
        $template = $this->template[$model];
        if ($channel->template) {
            $template = $channel->template;
        }

        //模板变量
        $value = [
            'channel' => $channel,
        ];

        //处理列表模型
        if ($model == $this->list_model) {
            $list = DB::table('article')
                ->select(
                    'id', 'title', 'channelId', 'img', 'author', 'readCount', 'linkUrl', 'desc',
                    'isTop', 'isPush', 'isBold', 'isImg', 'isLink', 'createTime', 'updateTime'
                )
                ->where('channelId', $channel->id)
                ->where('show', 1)
                ->paginate(15);
            $value['list'] = $list;
        }

        //处理下载模型
        if ($model == $this->download_model) {
            $download = DB::table('download')->where('channelId', $channel->id)->paginate(15);
            $value['download'] = $download;
        }
        return view($template, $value);
    }
}
