<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/index.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/bottom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <title>首页</title>
</head>
<body>
<div class="main">
    <div class="header">
        <div class="headerTop">
            <input type="text" placeholder="搜索你想要的商品" onclick="toSearch()">
        </div>
        <div class="sliderContainer" id="sliderContainer">
            <div id="list">
                <img src="img/slider1.jpg" alt="1"/>
                <img src="img/slider2.jpg" alt="2"/>
                <img src="img/slider3.jpg" alt="3"/>
            </div>
            <div id="buttons">
                <span index="1" class="on"></span>
                <span index="2"></span>
                <span index="3"></span>
            </div>
        </div>
    </div>
    <div class="mainTop">
        <i class="iconfont hotIcon">&#xe623;</i>
        <span>热卖商品</span>
    </div>
    <div class="mainBottom">
        @foreach($data as $v)
            <div class="mainItem" key="{{$v['id']}}" onclick="detail(this)">
                <img src="{{$v['pic_url']}}" alt="">
                <div class="bookDescribe">
                    <span>{{$v['name']}}</span>
                    <span class="money">￥{{$v['fee']}}</span>
                </div>
            </div>
        @endforEach
    </div>
</div>
<div class="bottom">
    <div class="current" id="index" onclick="indexPage()">
        <i class="iconfont">&#xe603;</i>
        <a>首页</a>
    </div>
    <div id="sort">
        <i class="iconfont" onclick="sort()">&#xe604;</i>
        <a>分类</a>
    </div>
    <div id="cart">
        <i class="iconfont" onclick="cart()">&#xe70e;</i>
        <a>购物车</a>
    </div>
    <div id="me">
        <i class="iconfont" onclick="me()">&#xe644;</i>
        <a>我的</a>
    </div>
</div>
</body>
<script>
    function detail(obj) {
        let id = obj.getAttribute('key');
        window.location.href = '/bb_wechat/public/detail?id='+id;
    }
    function toSearch() {
        window.location.href = '/bb_wechat/public/search/view';
    }
    function indexPage() {
        window.location.href = '/bb_wechat/public/index?sheet=1';
    }

    function sort() {
        window.location.href = '/bb_wechat/public/index?sheet=2';
    }

    function cart() {
        window.location.href = '/bb_wechat/public/index?sheet=3';
    }

    function me() {
        window.location.href = '/bb_wechat/public/index?sheet=4';
    }
</script>
<script src="{{URL::asset('js/slider.js')}}"></script>
</html>