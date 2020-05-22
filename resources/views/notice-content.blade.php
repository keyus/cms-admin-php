@extends('layout.app')

@section('banner')
<div class="ms-slider ms-second-banner" style="background-image: url('/img/banner2.jpg');">
    <div class="container">
        <h1>{{$channel->title}}</h1>
        <p>{{$channel->desc}}</p>
    </div>
</div>
@endsection


@section('body')

<div class="ms-bodys notice-content">
        <h3>
            {{$article->title}}
        </h3>
        <div class="time"><span>时间：{{ date('Y/m/d', strtotime($article->createTime) ) }}</span></div>
        <div class="content">
            {!!$article->content!!}
        </div>
    </div>
@endsection
