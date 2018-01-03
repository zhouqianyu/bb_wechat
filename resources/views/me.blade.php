<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/bottom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/me.css')}}">
    <title>我的</title>
</head>
<body>
    <div class="header">
        <img src="img/user.jpg" alt="" class="headerImg">
        <i class="iconfont settingIcon" style="font-size: 22px">&#xe607;</i>
    </div>
    <div class="headerBottom">
        <div class="headerBottomLeft">
            <span class="number">{{$user['point']}}</span>
            <span>积分</span>
        </div>
        <div>
            <span class="number">{{$collect}}</span>
            <span>收藏</span>
        </div>
    </div>
    <div class="myOrder">
        <div class="myOrderTop">
            <span class="myOrderTopLeft">我的订单</span>
            <span class="rightText" sheet="0" onclick="toBill(this)">查看所有订单</span>
            <i class="iconfont rightArrow" style="font-size: 14px">&#xe661;</i>
        </div>
        <div class="myOrderBottom">
            <div sheet="1" onclick="toBill(this)">
                <i class="iconfont">&#xe60f;</i>
                <span>待付款</span>
                @if($waitPay>0)
                <span class="nums">{{$waitPay}}</span>
                @endif
            </div>
            <div sheet="2" onclick="toBill(this)">
                <i class="iconfont">&#xe609;</i>
                <span>待发货</span>
                @if($waitSend>0)
                <span class="nums">{{$waitSend}}</span>
                @endif
            </div>
            <div sheet="3" onclick="toBill(this)">
                <i class="iconfont">&#xe635;</i>
                <span>待收货</span>
                @if($waitReceive>0)
                <span class="nums">{{$waitReceive}}</span>
                @endif
            </div>
            <div sheet="4" onclick="toBill(this)">
                <i class="iconfont">&#xe64e;</i>
                <span>退款/售后</span>
                @if($waitBack>0)
                    <span class="nums">{{$waitBack}}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="bottom">
        <div id="index">
            <i class="iconfont">&#xe603;</i>
            <a>首页</a>
        </div>
        <div id="sort">
            <i class="iconfont">&#xe604;</i>
            <a>分类</a>
        </div>
        <div id="cart">
            <i class="iconfont">&#xe70e;</i>
            <a>购物车</a>
        </div>
        <div id="me" class="current">
            <i class="iconfont">&#xe644;</i>
            <a>我的</a>
        </div>
    </div>
</body>
<script src="js/bottom.js"></script>
<script>
    function toBill(obj){
        let sheet = obj.getAttribute('sheet');
        window.location.href = '/bb_wechat/public/bill?sheet='+sheet;
    }
</script>
</html>