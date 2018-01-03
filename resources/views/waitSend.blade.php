<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/myOrder.css')}}">
    <title>我的订单</title>
</head>
<body>
<div class="header" id="header">
    <div id="allOrder" sheet="0">全部</div>
    <div class= id="waitPay"  sheet="1">待付款</div>
    <div id="waitSend" class="currentHeader" sheet="2">待发货</div>
    <div id="waitReceive"  sheet="3">待收货</div>
    <div id="waitReceive" sheet="4">售后中</div>
</div>
<div class="main">
    @foreach($data as $v)
    <div class="mainItemWaitSend">
        <div class="mainTop">
            <span class="mainTopLeft">订单号: {{$v['code']}}</span>
            <span class="rightStatus">买家已付款</span>
        </div>
        @foreach($v['books'] as $book)
        <div class="mainCenter">
            <img src="{{$book['pic_url']}}" alt="" class="mainCenterImg">
            <div class="mainCenterContainer">
                <span>{{$book['name']}}</span>
                <span>￥{{$book['fee']}}</span>
            </div>
            <span class="nums">
                    x{{$book['pivot']['num']}}
                </span>
        </div>
        @endforeach
        <div class="mainBottom">
            <span class="totalText">共{{$v['amount']}}件商品,小计:</span>
            <span class="money">￥{{$v['total']}}</span>
        </div>
    </div>
    @endforeach

</div>
</body>
<script>
    let headers = document.getElementById('header').childNodes;
    headers.forEach(function (item) {
        item.onclick = function () {
            let sheet = this.getAttribute('sheet');
            window.location.href = '/bb_wechat/public/bill?sheet='+sheet;
        }
    });
</script>
</html>