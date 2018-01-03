<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/bookDetail.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>商品详情</title>
</head>
<body>
    <div class="main">
        <img src="{{$data['pic_url']}}" class="bookDetailImg">
        <i class="iconfont backBtn" style=" font-size: 28px;" onclick="toIndex()">&#xe600;</i>
        <div class="bookDetailCenter">
            <span>{{$data['name']}}</span>
            <span class="money">￥{{$data['fee']}}</span>
        </div>
        <div class="bookDetailBottom">
            <span>快递: 6.00</span>
            <span>月销量:{{$data['sale_num']}}</span>
            <span>库存:{{$data['remain']}}</span>
        </div>
    </div>
    <div class="bottom">
        <div>
            <span key="{{$data['id']}}" onclick="addCart(this)">加入购物车</span>
        </div>
    </div>
</body>
<script>
    function addCart(obj) {
        let id = obj.getAttribute('key');
        let params = new URLSearchParams();
        params.append('bookId',id);
        axios.post('/bb_wechat/public/cart/add',params)
            .then(function (res) {
                if (res.data.code===200){
                    window.location.href = '/bb_wechat/public/index?sheet=3';
                }
            });
    }
    function toIndex() {
        window.location.href = '/bb_wechat/public/index';
    }
</script>
</html>