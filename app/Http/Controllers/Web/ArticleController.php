<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * 文章内容 页
 */
class ArticleController extends Controller
{
    protected $template = [
        0 => 'list',
        1 => 'single',
        2 => 'download',
    ];
    public function index(Request $request, $name)
    {
        $channel = DB::table('channel')->where('name',$name)->first();
        $template = $this->template[$channel->model];
        if($channel->template){
            $template = $channel->template;
        }

        return view($template,[
            'channel' => $channel,
        ]);
    }
}
