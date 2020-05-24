@extends('layout.app')

@section('banner')
<div class="ms-slider ms-second-banner" style="background-image: url('@if($channel->banner) {{$channel->banner}} @else /img/banner/notice_banner.jpg @endif');">
    <div class="container">
        <h1>{{$channel->title}}</h1>
        <div>
            <pre>{{$channel->desc}}</pre>
        </div>
    </div>
</div>
@endsection


@section('body')
<div class="ms-bodys">
        <div class="title-important container">
            <h3>
                <span>{{$channel->title}}</span>
            </h3>
        </div>

        <ul class="list-notice">
            @foreach ($list as $it)
                <li>
                    <a href="{{url('news/'.$it->id)}}">
                        <h3>
                            {{$it->title}} <span>{{date('Y/m/d',strtotime($it->createTime))}}</span>
                        </h3>
                    </a>
                </li>
            @endforeach
        </ul>

        {{ $list->links() }}
    </div>
@endsection
