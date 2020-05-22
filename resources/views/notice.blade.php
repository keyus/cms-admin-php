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
                <span>重要通知</span>
            </h3>
        </div>

        <ul class="list-notice">
            <li>
                <a href="">
                    <h3>
                        冬令时转夏令时交易时间调整冬令时转夏令时交易时间调整 <span>2020/03/28</span>
                    </h3>
                </a>
            </li>
            <li>
                <a href="">
                    <h3>
                        冬令时转夏令时交易时间调整冬令时转夏令时交易时间调整 <span>2020/03/28</span>
                    </h3>
                </a>
            </li>
            <li>
                <a href="">
                    <h3>
                        冬令时转夏令时交易时间调整冬令时转夏令时交易时间调整 <span>2020/03/28</span>
                    </h3>
                </a>
            </li>
            <li>
                <a href="">
                    <h3>
                        冬令时转夏令时交易时间调整冬令时转夏令时交易时间调整 <span>2020/03/28</span>
                    </h3>
                </a>
            </li>
            <li>
                <a href="">
                    <h3>
                        冬令时转夏令时交易时间调整冬令时转夏令时交易时间调整 <span>2020/03/28</span>
                    </h3>
                </a>
            </li>
            <li>
                <a href="">
                    <h3>
                        冬令时转夏令时交易时间调整冬令时转夏令时交易时间调整 <span>2020/03/28</span>
                    </h3>
                </a>
            </li>
        </ul>
    </div>
@endsection
