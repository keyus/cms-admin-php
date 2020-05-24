@extends('layout.app')

@section('banner')
@if($channel)
<div class="ms-slider ms-second-banner" style="background-image: url('@if($channel->banner) {{$channel->banner}} @else /img/banner/list_banner.jpg @endif');">
    <div class="container">
        <h1>{{$channel->title}}</h1>
        <p>{{$channel->desc}}</p>
    </div>
</div>
@else
<div class='header-space'></div>
@endif
@endsection


@section('body')
    <div class="content-wrapper">
        <div class="flex">
            <div class="content-default">
                <div class="link-list">
                    @if($channel)
                    <a href="{{url('channel/'.$channel->name)}}">&lt; 返回列表</a>
                    @else
                    <a href="{{url('/')}}">&lt; 返回首页</a>
                    @endif
                </div>
                <h1>{{$article->title}}</h1>
                <div class="tag">
                    <span>{{$article->createTime}}</span>
                </div>
                <article>
                    {!!$article->content!!}
                </article>
                <div class="newer">
                    <p>
                        上一篇:
                        @if($pre)
                            <a href="{{url('news/'.$pre->id)}}">{{$pre->title}}</a>
                        @else
                            <span>没有了</span>
                        @endif
                    </p>
                    <p>下一篇:
                        @if($next)
                            <a href="{{url('news/'.$next->id)}}">{{$next->title}}</a>
                        @else
                            <span>没有了</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="content-right">

                <div class="www-push">
                    <a href="{{url('channel/calendar')}}">
                        <img src="/img/icon/icon-data.svg" />
                        财经日历
                    </a>
                    <a href="">
                        <img src="/img/icon/icon-info.svg" />
                        网上开户
                    </a>
                    <a href="">
                        <img src="/img/icon/icon-add.svg" />
                        保证金计算器
                    </a>
                </div>
                <h5>
                    <span>相关内容</span>
                </h5>
                <ul>
                    @foreach($list as $it)
                        <li>
                            <a href="{{url('news/'.$it->id)}}">
                                <span>{{ date('m/d', strtotime($it->createTime) ) }}</span>
                                {{$it->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="content-ad">
                    <a href=""><img src="/img/test4.png" alt=""></a>
                    <a href=""><img src="/img/test4.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
@endsection
