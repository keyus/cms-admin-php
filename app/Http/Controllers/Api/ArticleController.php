<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * 文章列表
     */
    function list(Request $request) {
        $request->validate([
            'id' => 'integer',
            'attr' => 'integer',
            'channelId' => 'integer',
        ], [
            'id.integer' => '参数错误',
        ]);
        $id = $request->id;
        $title = $request->title;
        // attr [0 全部  1头条(isTop)  2推荐(isPush) 3加粗(isBold) 4图片(img)  5跳转(isLink)]
        $attr = $request->attr;    
        $channelId = $request->channelId;


        $article = DB::table('article')
        ->leftJoin('channel','article.channelId','=','channel.id')
        ->select(
            'article.id', 'article.title', 'article.channelId', 'article.show', 
            'article.author','article.img','article.readCount','article.isTop','article.isPush',
            'article.isBold','article.isLink','article.createTime','article.updateTime',
            'channel.title as channelName'
        );

        if($id) $article->where('article.id',$id);
        if($title) $article->where('article.title',$title);
        if($channelId) $article->where('article.channelId',$channelId);
        if($attr == 1) $article->where('article.isTop',1);
        if($attr == 2) $article->where('article.isPush',1);
        if($attr == 3) $article->where('article.isBold',1);
        if($attr == 4) $article->whereNotNull('article.isImg',1);
        if($attr == 5) $article->where('article.isLink',1);

        return $article->orderBy('article.createTime','desc')->paginate(15);

    }

    /**
     * 获取单个文章
     */
    public function get(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ], [
            'id.required' => '参数错误',
            'id.integer' => '参数错误',
        ]);
        $id = $request->id;
        $res = DB::table('article')
            ->where('id', $id)
            ->first();
        return (array) $res;
    }

    /**
     * 删除一个文章
     */
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ], [
            'id.required' => '参数错误',
            'id.integer' => '参数错误',
        ]);

        $id = $request->id;

        $find = DB::table('article')
            ->where('id', $id)
            ->first();
        if ($find->file) {
            try {
                @unlink(public_path($find->img));
            } catch (ErrorException $e) {
            }
        }

        $res = DB::table('article')
            ->where('id', $id)
            ->delete();
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

    /**
     * 添加文章
     */
    public function add(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'channelId' => 'required|integer',
                'attr' => 'array',
                'createTime' => 'date',
            ],
            [
                'title.required' => '请输入内容标题',
                'channelId.required' => '请选择栏目ID',
                'channelId.integer' => '栏目ID不存在',
            ]
        );
        $title = $request->title;
        $channelId = $request->channelId;
        $attr = $request->attr;
        $linkUrl = $request->linkUrl;
        $img = $request->img;
        $content = $request->content;
        $seoTitle = $request->seoTitle;
        $seoKey = $request->seoKey;
        $seoDesc = $request->seoDesc;
        $author = $request->author;
        $readCount = $request->readCount;
        $show = $request->show;
        $createTime = $request->createTime;

        $row = [
            'title' => $title,
            'channelId' => $channelId,
            'linkUrl' => $linkUrl,
            'img' => $img,
            'content' => $content,
            'seoTitle' => $seoTitle,
            'seoKey' => $seoKey,
            'seoDesc' => $seoDesc,
            'author' => $author,
            'readCount' => $readCount,
            'show' => $show,
        ];
        if($createTime) $row['createTime'] = $createTime;
        if(is_array($attr)){
            if(in_array(1,$attr)) $row['isTop'] = 1;
            if(in_array(2,$attr)) $row['isPush'] = 1;
            if(in_array(3,$attr)) $row['isBold'] = 1;
            if(in_array(4,$attr)) $row['isImg'] = 1;
            if(in_array(5,$attr)) $row['isLink'] = 1;
        }

        $res = DB::table('article')
            ->insert($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }

    /**
     * 编辑文章
     */
    public function edit(Request $request)
    {
        $request->validate(
            [
                'id' => 'required|integer',
                'title' => 'required',
                'channelId' => 'required|integer',
                'attr' => 'array',
                'createTime' => 'date',
            ],
            [
                'id.required' => 'id不存在',
                'id.integer' => 'id参数错误',
                'title.required' => '请输入内容标题',
                'channelId.required' => '请选择栏目ID',
                'channelId.integer' => '栏目ID不存在',
            ]
        );
        $id = $request->id;
        $title = $request->title;
        $channelId = $request->channelId;
        $attr = $request->attr;
        $linkUrl = $request->linkUrl;
        $img = $request->img;
        $content = $request->content;
        $seoTitle = $request->seoTitle;
        $seoKey = $request->seoKey;
        $seoDesc = $request->seoDesc;
        $author = $request->author;
        $readCount = $request->readCount;
        $show = $request->show;
        $createTime = $request->createTime;

        $row = [
            'title' => $title,
            'channelId' => $channelId,
            'linkUrl' => $linkUrl,
            'img' => $img,
            'content' => $content,
            'seoTitle' => $seoTitle,
            'seoKey' => $seoKey,
            'seoDesc' => $seoDesc,
            'author' => $author,
            'readCount' => $readCount,
            'show' => $show,
            'updateTime' => date('y-m-d H:i:s'),
        ];
        if($createTime) $row['createTime'] = $createTime;
        if(is_array($attr)){
            if(in_array(1,$attr)) $row['isTop'] = 1;
            if(in_array(2,$attr)) $row['isPush'] = 1;
            if(in_array(3,$attr)) $row['isBold'] = 1;
            if(in_array(4,$attr)) $row['isImg'] = 1;
            if(in_array(5,$attr)) $row['isLink'] = 1;
        }

        $res = DB::table('article')
            ->where('id',$id)
            ->update($row);
        if ($res) {
            return response()->json(['data' => true]);
        }
        return response()->json(['message' => '操作失败'], 522);
    }
}
