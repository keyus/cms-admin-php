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
<div class="ms-bodys">
        <div class="title-important container">
            <h3>
                <span>{{$channel->title}}</span>
            </h3>
        </div>

        <ul class="list-notice">
            @foreach ($list as $it)
                <li>
                    <a href="{{url('/news/'.$it->id)}}">
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
