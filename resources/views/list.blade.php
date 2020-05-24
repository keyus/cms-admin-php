@extends('layout.app')

@section('banner')
<div class="ms-slider ms-second-banner" style="background-image: url('@if($channel->banner) {{$channel->banner}} @else /img/banner/list_banner.jpg @endif');">
    <div class="container">
        <h1>{{$channel->title}}</h1>
        <div>
            <pre>{{$channel->desc}}</pre>
        </div>
    </div>
</div>
@endsection


@section('body')

<div class="list-title">
    {{$channel->title}}
</div>
<div class="ms-bodys">
    <ul class="list-default">
        @foreach ($list as $it)
        <li>
            @if ($it->img)
                <div class="item-left">
                    <img src="{{$it->img}}" alt="{{$it->title}}">
                </div>
            @endif
            <div class="item-right">
                <h4>
                    <a href="{{url('news/'.$it->id)}}">{{$it->title}}</a>
                </h4>
                <p>{{$it->desc}}</p>
                <div class="time">{{$it->createTime}}</div>
            </div>
        </li>
        @endforeach
    </ul>
    {{ $list->links() }}
</div>
@endsection
