@extends('layout.app')

@section('banner')
<div class="ms-slider ms-second-banner" style="background-image: url('@if($channel->banner) {{$channel->banner}} @else /img/banner/download_banner.jpg @endif');">
    <div class="container">
        <h1>{{$channel->title}}</h1>
        <div>
            <pre>{{$channel->desc}}</pre>
        </div>
    </div>
</div>
@endsection


@section('body')
<div class="list-download-wrapper">
    <ul class="list-download">
        @foreach ($download as $it)
        <li>
            <a href="{{$it->file}}">
                <img src="{{$it->img}}" alt="{{$it->name}}">
            </a>
            <p class="title">{{$it->name}}</p>
            <p class="time">{{$it->desc}}</p>
            <a class="btn" href="{{$it->file}}" target="_blank">立即下载</a>
        </li>
        @endforeach
    </ul>
    {{ $download->links()}}
</div>
@endsection
