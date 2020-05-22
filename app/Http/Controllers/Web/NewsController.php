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
        if ($article) {
            $channel = DB::table('channel')
                ->select('id', 'title', 'name', 'desc', 'aritcleTemplate')
                ->where('id', $article->channelId)->first();
                
            if ($channel->aritcleTemplate) {
                $template = $channel->aritcleTemplate;
            }
            // dd($template);
            return view($template, [
                'article' => $article,
                'channel' => $channel,
            ]);
        }

    }
}
