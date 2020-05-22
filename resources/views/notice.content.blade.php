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
            五月展期通知
        </h3>
        <div class="time"><span>时间：2019-28-28</span></div>
        <div class="content">
            <p>尊敬的客户：</p>
            <p>西德萨斯原油期货（CL-OIL）、恐慌指数期货（VIX）与富时中国A50指数（CHINA50）将于对应日期开盘自动展期。展期后的新合约最终呈现的差价已包含点差的成本并将以Balance形式体现，请持仓交易的客户按需及时调整仓位。
            </p>
            <p>具体展期时间如下图所示，以下均为平台时间，GMT(格林威治标准时间)+3。日期可能会有所变更，请依实际盘面为准。</p>
            <p><img class="alignnone size-full wp-image-5895 aligncenter lazy-loaded"
                    src="https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png" data-lazy-type="image"
                    data-src="https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png" alt="" width="662"
                    height="216"
                    srcset="https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png 662w, https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512-300x98.png 300w"
                    data-srcset="" sizes="(max-width: 662px) 100vw, 662px"><noscript><img
                        class="alignnone size-full wp-image-5895 aligncenter"
                        src="https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png" alt="" width="662"
                        height="216"
                        srcset="https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512.png 662w, https://cn.ixsecurities.com/wp-content/uploads/2020/05/20200512-300x98.png 300w"
                        sizes="(max-width: 662px) 100vw, 662px" /></noscript></p>
            <p><strong>请注意：<br>
                    ．系统将自动进行展期，当前所有仓位仍将维持开放状态。<br>
                    ．合约到期日当天，新开仓位将会通过反映到期合约和新合约之间价差的展期费用、或信用金的形式进行调整。<br>
                    ．客户可在到期日之前关闭所有所持仓位，以避开差价合约展期。<br>
                    ．客户需确保在该次合约展期前进行止盈和止损调整。</strong></p>
            <p>IX Securities将持续为客户提供优质且专业的服务，若您有任何疑问或需要协助，请与我们联系，感谢您的理解和支持。</p>
        </div>
    </div>
@endsection
