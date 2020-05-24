<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#000000" />
    <title>{{$site->name}}</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/style.css">
    @yield('css')
</head>

<body>
    <div class="ms-banner">
        <header class="ms-header">
            <div class="container flex flex-center">
                <div class="ms-logo">
                    <a href="{{url('/')}}"><img src="/img/logo.png" alt="logo" /></a>
                </div>
                <ul class="ms-menu">
                    <li><a href="{{url('/')}}" class="{{ request()->is('/') ? 'active' : '' }}">首页</a></li>
                    @foreach ($nav as $it)
                        <li><a href="{{url('channel/'.$it->name)}}" class="{{ request()->is('channel/'.$it->name.'*') ? 'active' : '' }}">{{$it->title}}</a></li>
                    @endforeach
                </ul>
                <div class="ms-user">
                    <a href="">登录</a>
                    <a href="">注册</a>
                </div>
            </div>
        </header>
        @yield('banner')
    </div>

    @yield('body')
    <footer class="footer">
        <div class="footer-body">
            <div class="container">
                <h3>{{$site->footer_title}}</h3>
                <p>{{$site->footer_desc}}</p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                {{$site->copyright}}
            </div>
        </div>
    </footer>

    @yield('script')
</body>

</html>
