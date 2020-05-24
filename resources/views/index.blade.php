@extends('layout.app')

@section('banner')
<!-- style="background-image: url('./img/banner2.jpg');" -->
<div class="ms-slider">
    <div class="ms-slider-item"
        style="background-image: url('@if($banner) {{$banner->img}} @else /img/banner/banner.jpg  @endif')">
        <span class="banner-title"><img src='/img/banner-title.png' alt="" /></span>
        <span class="banner-button">
            <a href="">会员在线开户</a>
        </span>
        <span class="banner-text">交易投资外汇（FOREX）、及其它商品和差价合约（CFD）是高风险的活动。请注意你的投资收益风险。</span>
    </div>
</div>
@endsection


@section('body')

@if($notice)
<div class="ms-net-notice">
    <div class="container">
        <a href="{{url('news/'.$notice->id)}}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="css-n8k3dy"><path d="M12.867 18.47l5.13-.94L15.517 4l-5.18.95-3.25 3.94-4.85.89.5 2.71-1.97.36.36 1.97 1.97-.36.44 2.42 1.97-.36.79 4.28 1.97-.36-.79-4.28.98-.18 4.41 2.49zm-5.76-4.28l-1.97.36-.58-3.17 3.61-.66 3.25-3.92 2.5-.46 1.76 9.59-2.46.45-4.4-2.51-1.71.32zM22.871 8.792l-2.99.55.362 1.967 2.99-.55-.362-1.967zM19.937 13.183l-1.135 1.647 2.503 1.725 1.135-1.646-2.503-1.726zM19.006 4.052l-1.725 2.503 1.646 1.135 1.726-2.503-1.647-1.135z" fill="currentColor"></path></svg>
            {{$notice->title}}
            {{date('m-d', strtotime($notice->createTime))}}
        </a>
        <a href="{{url('channel/'.$notice_channel->name)}}" class="more">更多&gt;</a>
    </div>
</div>
@endif

@if($ad)
<div class="ms-ad">
    <div class="container ad-block">
        @foreach($ad as $it)
            <a href="@if($it->url){{$it->url}}@else javascript:; @endif">
                <img src="{{$it->img}}" alt="{{$it->title}}">
            </a>
        @endforeach
    </div>
</div>
@endif

<div class="container ms-notice-container">
    <div class="ms-notice">
        <h3>
            <strong>@if($m1_channel->title_show) {{$m1_channel->title_show}} @else {{$m1_channel->title}} @endif</strong>
            <a href="{{url('channel/'.$m1_channel->name)}}">更多</a>
        </h3>
        <ul>
            @foreach($m1 as $it)
                <li>
                    <a href="{{url('news/'.$it->id)}}">
                        <span class="time">
                            <i> {{date('d',strtotime($it->createTime))}}</i>
                            {{date('Y-m',strtotime($it->createTime))}}
                        </span>
                        <div>
                            <h6>{{$it->title}}</h6>
                            <p>{{$it->desc}}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="ms-desc">
        <h3>
            <strong>@if($m2->title_show){{$m2->title_show}} @else {{$m2->title}} @endif</strong>
            <a href="{{url('/channel/'.$m2->name)}}">详情</a>
        </h3>
        <div class="intro">
            <img src="{{$m2->img}}" alt="">
            <p>
                {{$m2->content_desc}}
            </p>
        </div>
    </div>
</div>

<div class="ms-block">

    <div class="ms-title">
        <div class="container">
            <span></span>
            @if($m_title){{$m_title}} @else 行业动态 @endif
            <span></span>
        </div>
    </div>
    <div class="ms-news">
        <div class="container">
            <div class="item">
                <h5><span>培训中心</span></h5>
                <ul>
                    <li class="first">
                        <a href="">
                            <span>XM重要通知 :8月银行假期日</span>
                            <label>2019-06-11 05:01</label>
                            <img src="./img/test2.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="item item-1">
                <h5><span>行业新闻</span></h5>
                <ul>
                    <li class="first">
                        <a href="">
                            <span>XM重要通知 :8月银行假期日</span>
                            <label>2019-06-11 05:01</label>
                            <img src="./img/test2.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="item item-2">
                <h5><span>市场研究</span></h5>
                <ul>
                    <li class="first">
                        <a href="">
                            <span>XM重要通知 :8月银行假期日</span>
                            <label>2019-06-11 05:01</label>
                            <img src="./img/test2.jpg" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><img src="./img/test.png" alt=""></span>
                            <span>
                                MBG Markets – CFD合约到期时间表_2019年6月
                                <label>2019-06-11 05:01</label>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
