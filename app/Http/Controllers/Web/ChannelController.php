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
    protected $template = [
        0 => 'channel',
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
