<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 文章内容 页
 */
class NewsController extends Controller
{
    protected $template = 'news';
    public function index(Request $request, $id)
    {
        $article = DB::table('article')->where('id', $id)->first();
        $template = $this->template;
        $channel = null;

        if ($article) {

            //查找栏目
            if ($article->channelId) {

                $channel = DB::table('channel')
                    ->select('id', 'title', 'name', 'desc', 'aritcleTemplate')
                    ->find($article->channelId);

                if ($channel->aritcleTemplate) {
                    $template = $channel->aritcleTemplate;
                }
            }

            //上一篇  如果查找到文章栏目， 关联文章栏目 id
            $pre = DB::table('article')
                ->select('id', 'title', 'img', 'createTime')
                ->where('id', '<', $id)
                ->where('show', 1);
            if ($channel) {
                $pre->where('channelId', $channel->id);
            }
            $pre = $pre->orderBy('id', 'desc')->first();

            //下一篇 如果查找到文章栏目， 关联文章栏目 id
            $next = DB::table('article')
                ->select('id', 'title', 'img', 'createTime')
                ->where('id', '>', $id)
                ->where('show', 1);
            if ($channel) {
                $next->where('channelId', $channel->id);
            }
            $next = $next->orderBy('id')->first();

            //最新内容 10条
            $list = DB::table('article')
                ->select('id', 'title', 'img', 'createTime')
                ->where('id', '<>', $id)
                ->where('show', 1)
                ->orderBy('createTime', 'desc')
                ->limit(10)
                ->get();

            $values = [
                'article' => $article,
                'channel' => $channel,
                'pre' => $pre,
                'next' => $next,
                'list' => $list,
            ];

            // dd($template);
            return view($template, $values);
        }

    }
}
