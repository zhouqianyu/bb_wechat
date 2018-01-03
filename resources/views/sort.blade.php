<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/bottom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/sort.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>分类</title>
</head>
<body>
    <div class="main">
        <div class="mainLeft" id="mainLeft">
            <span type="1">css</span>
            <span type="2">js</span>
            <span type="3">小说</span>
            <span type="4">历史</span>
            <span type="5">其他</span>
        </div>
        <div class="mainRight">
            @foreach($data as $v)
            <div class="mainItem" key="{{$v['id']}}">
                <img src="{{$v['pic_url']}}" alt="" style="width: 118px; height: 120px">
                <div class="mainItemBottom">
                    <span class="bookName">{{$v['name']}}</span>
                    <span class="money">￥{{$v['fee']}}</span>
                </div>
                <i class="iconfont rightIcon" key="{{$v['id']}}" onclick="addCart(this)">&#xe70e;</i>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bottom">
        <div id="index">
            <i class="iconfont">&#xe603;</i>
            <a>首页</a>
        </div>
        <div id="sort" class="current">
            <i class="iconfont">&#xe604;</i>
            <a>分类</a>
        </div>
        <div id="cart">
            <i class="iconfont">&#xe70e;</i>
            <a>购物车</a>
        </div>
        <div id="me">
            <i class="iconfont">&#xe644;</i>
            <a>我的</a>
        </div>
    </div>
</body>
<script src="js/bottom.js"></script>
<script>
    let bar = document.getElementById('mainLeft');
    bar.childNodes['{{$type*2-1}}'].className = "currentSort";
    bar.childNodes.forEach(function (item) {
        item.onclick = function () {
            let type = this.getAttribute('type');
            window.location.href = '/bb_wechat/public/index?sheet=2&type='+type;
        }
    });
    function addCart(obj) {
        let id = obj.getAttribute('key');
//        console.log(obj);
        let params = new URLSearchParams();
        params.append('bookId',id);
        axios.post('/bb_wechat/public/cart/add',params);
    }
    let mainItems = document.getElementsByClassName('mainItem');
    for(let item of mainItems) {
        item.onclick = function (e) {
            if(e.target.className != 'iconfont rightIcon') {
                console.log(e.target);
            }
        }
    }
//    console.log(mainItems);
</script>
</html>