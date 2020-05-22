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
    <div class="fx-calendar" id="calendar">
        <div class="tab">
            <a :class="{ active: active === 2 }" @click="toggle(2)">本周</a>
            <a :class="{ active: active === 1 }" @click="toggle(1)">今日</a>
        </div>
        <div :class="{ 'fx-box' : true, none: active === 1}">
            <div id="economicCalendarWidget"></div>
        </div>
        <div :class="{ 'fx-box' : true, none: active === 2}">
            <div id="economicCalendarWidget2"></div>
        </div>
    </div>
@endsection

@section('script')
<script src="/js/vue.min.js"></script>
<script type="text/javascript" src="https://c.mql5.com/js/widgets/calendar/widget.js?6"></script>
<script>
    new Vue({
        el: '#calendar',
        data:{
            active: 2,
        },
        mounted() {
            //1天   2周
            new economicCalendar({ id: 'economicCalendarWidget', width: "100%", height: "100%", mode: 2, lang: "zh", dateformat: "YMD" });
            new economicCalendar({ id: 'economicCalendarWidget2', width: "100%", height: "100%", mode: 1, lang: "zh", dateformat: "YMD" });
        },
        methods: {
            toggle(val){
                this.active = val;
            }
        }
    })
</script>
@endsection
