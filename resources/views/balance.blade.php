<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/balance.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>结算</title>
</head>
<body>
    <div class="header" onclick="toAddress()">
        <i class="iconfont" style="font-size: 20px; padding-left: 1rem">&#xe611;</i>
        <div class="headerCenter">
            <span>收货人: <span id="name">{{isset($address['name'])?$address['name']:''}}</span></span>
            <span class="receiveAddress">收货地址: <span id="address"> {{isset($address['address'])?$address['address']:''}}</span></span>
        </div>
        <i class="iconfont rightArrow">&#xe661;</i>
    </div>
    @foreach($data['books'] as $book)
    <div class="main">
        <div class="mainItem">
            <img src="{{$book['pic_url']}}" alt="" class="mainItemImg">
            <div class="mainItemCenter">
                <span>{{$book['name']}}</span>
                <span class="money">￥{{$book['fee']}}</span>
            </div>
            <span class="bookNums">x{{$book['pivot']['num']}}</span>
        </div>
    </div>
    @endforeach
    <div class="mainBottom">
        <div class="point">
            <div>
                <span>积分抵扣</span>
                <span>此单可抵<span id="needPoint">{{floor($data['total']/10)}}</span>,账户积分{{$point}}</span>
            </div>
            <input type="checkbox" class="checkPoint" id="checkPoint">
        </div>
        <div class="remark">
            <span class="remarkSpan">订单备注</span>
            <input type="text" placeholder="请填写您的特殊要求">
        </div>
        <div class="totalMoney">
            <span>共{{$amount}}件商品，商品总价￥{{$data['total']}}</span>
        </div>
        <div class="transMoney">
            <span>运费￥6</span>
        </div>
    </div>
    <div class="bottom" onclick="pay()">
        提交订单
    </div>
</body>
<script>
    window.localStorage.setItem('id','{{$data['id']}}');
    let point = document.getElementById('checkPoint');
    let needPoint = parseInt(document.getElementById('needPoint').innerHTML);
    {{--if (needPoint > '{{$point}}' || needPoint === 0) point.checked = true;--}}
    function pay() {
        let id = window.localStorage.getItem('id');
        let params = new URLSearchParams();
        params.append('id',id);
        params.append('usePoint',point.checked);
        axios.post('/bb_wechat/public/pay',params)
            .then(function () {
                window.localStorage.removeItem('id');
                window.location.href = '/bb_wechat/public/index?sheet=4';
            });
    }
    function toAddress() {
        window.location.href = '/bb_wechat/public/choiceAddress'
    }
</script>
</html>