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
<div class="list-download-wrapper">
        <ul class="list-download">
            <li>
                <a href="">
                    <img src="/img/test7.jpg" alt="">
                </a>
                <p class="title">【高达5000USD】惊喜等您前来!</p>
                <p class="time">版本：1.10.2 2019/12/23</p>
                <a class="btn" href="">立即下载</a>
            </li>
            <li>
                <a href="">
                    <img src="/img/test7.jpg" alt="">
                </a>
                <p class="title">【高达5000USD】惊喜等您前来!</p>
                <p class="time">版本：1.10.2 2019/12/23</p>
                <a class="btn" href="">立即下载</a>
            </li>
        </ul>
        <div class="pagination">
            <span class="current">1</span>
            <a class="page">2</a>
            <a class="page">3</a>
            <a class="page">4</a>
            <a class="page">5</a>
            <a class="page">2</a>
            <span class="extend">...</span>
            <a class="nextpostslink">»</a>
        </div>
    </div>
@endsection
