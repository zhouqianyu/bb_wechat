<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{'css/myOrder.css'}}">
    <title>我的订单</title>
</head>
<body>
<div class="header" id="header">
    <div id="allOrder" class="currentHeader" sheet="0">全部</div>
    <div class= id="waitPay"  sheet="1">待付款</div>
    <div id="waitSend"  sheet="2">待发货</div>
    <div id="waitReceive"  sheet="3">待收货</div>
    <div id="waitReceive" sheet="4">售后中</div>
</div>
<div class="main">
    @foreach($data as $v)
        <div class="@switch($v['type']) @case(1)mainItemWaitPay @break @case(2)mainItemWaitSend @break @case(3)mainItemWaitReceive @break @case(4)mainItemWaitSend @case(5)mainItemWaitSend @endswitch">
            <div class="mainTop">
                <span class="mainTopLeft">订单号: {{$v['code']}}</span>
                <span class="rightStatus">@switch($v['type']) @case(1)等待付款 @break @case(2)买家已付款 @break @case(3)卖家已发货 @case(4)售后申请中 @break @case(5) 已取消@endswitch</span>
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