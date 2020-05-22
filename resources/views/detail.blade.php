@extends('layout.app')

@section('banner')
<div class="ms-slider ms-second-banner" style="background-image: url('/img/banner2.jpg');">
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
        <div class="ms-channel-spa">
            <h1>
                <span></span>
                {{$channel->title}}
            </h1>

            <article>
                {!!$channel->content!!}
            </article>

        </div>
    </div>
@endsection
