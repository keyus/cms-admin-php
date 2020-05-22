<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="theme-color" content="#000000" />
    <title>首页</title>
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
                    <li><a href="{{url('/')}}" class="active">首页</a></li>
                    @foreach ($nav as $it)
                        <li><a href="{{url('/channel/'.$it->name)}}">{{$it->title}}</a></li>
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
                <h3>风险警告</h3>
                <p>
                    风险警告:所有投资都存在风险，都可能带来收益和损失，尤其是交易如外汇和差价合约等杠杆衍生品，会给您的投资带来高风险。这些衍生产品中许多都是杠杆产品，可能不适合所有投资者。杠杆在能够放大盈利的同时，也会将损失放大。杠杆衍生品的价格可能会快速的转向于您不利的局面，您的损失或超出您的投资额，并可能需要进一步支付您的亏损。在投资时，您必须了解您的资金所面临的风险。过去的表现并不能作为未来表现的参考。对决定是否投资做出再三考量是您的责任。在决定投资任何金融产品之前，您应认真考虑自己的投资目标、交易知识和经验以及承受损失的能力。如您对产品相关风险有任何疑问，请咨询独立专业人士。本公司不承担任何依照建议进行交易导致的损失。且本公司网站仅为会员客户提供第三方指导开户，并不参于任何金融衍生品的制定与交易.
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                © COPY RIGHTS - 2020 ALL RIGHTS RESERVED
            </div>
        </div>
    </footer>

    @yield('script')
</body>

</html>
