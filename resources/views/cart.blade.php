<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/bottom.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/iconfont.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>购物车</title>
</head>
<body>
    <div class="header">
        <span>笨笨书店</span>
    </div>
    <div class="main">
        @foreach($data as $v)
            <div class="mainItem">
                <input type="checkbox" name="checkbox" value="{{$v['cartId']}}" num = "{{$v['num']}}" fee = "{{$v['fee']}}" onclick="check(this)">
                <img src="{{$v['pic_url']}}" alt="" style="width: 107px; height: 104px">
                <div class="mainItemCenter">
                    <span>{{$v['name']}}</span>
                    <span class="money">￥{{$v['fee']}}</span>
                </div>
                <span class="rightNums">
                x{{$v['num']}}
            </span>
            </div>
        @endforeach
        <div class="selectContainer">
            <input type="checkbox" class="allSelectRadio" id="checkAll" onclick="checkAll(this.checked)">
            <span>全选</span>
            <span class="deleteText" onclick="deleteCart()">删除</span>
            <div class="count">
                <span onclick="toPay()">结算(<span id="total">0</span>)</span>
            </div>
        </div>
    </div>


    <div class="bottom">
        <div id="index" onclick="indexPage()">
            <i class="iconfont">&#xe603;</i>
            <a>首页</a>
        </div>
        <div id="sort" onclick="sort()">
            <i class="iconfont">&#xe604;</i>
            <a>分类</a>
        </div>
        <div id="cart"  class="current" onclick="cart()">
            <i class="iconfont">&#xe70e;</i>
            <a>购物车</a>
        </div>
        <div id="me" onclick="me()">
            <i class="iconfont">&#xe644;</i>
            <a>我的</a>
        </div>
    </div>
</body>
<script>
    let ids = new Set();
    let totalSpan = document.getElementById('total');
    let checkBoxs = document.getElementsByName('checkbox');
    let allCheck = document.getElementById('checkAll');
    function check (obj) {
        let total = parseFloat(totalSpan.innerHTML);
        let fee = obj.getAttribute('fee');
        let num = obj.getAttribute('num');
        let id = obj.value;
        if (obj.checked) {
            ids.add(id);
            total +=parseInt(num)*parseFloat(fee);
        }
        else {
            ids.delete(id);
            total -=parseInt(num)*parseFloat(fee);
        }
        totalSpan.innerHTML = total.toFixed(2);
        allCheck.checked = true;
        checkBoxs.forEach(function (item) {
            if(!item.checked) allCheck.checked = false
        })
    }
    function checkAll(checked) {
        checkBoxs.forEach(function (item) {
            item.checked = checked;
            ids.add(item.value);
        });
        totalSpan.innerHTML = checked?'{{$total}}':0;
    }
    function toPay() {
        let idsArr = toArray(ids);
        let params = new URLSearchParams();
        params.append('ids',idsArr);
        axios.post('/bb_wechat/public/toPay',params)
            .then(function (res) {
                let data=res.data;
                if (data.code===200){
                    window.location.href = '/bb_wechat/public/waitPay?id='+data.data;
                }
            })
    }
    function toArray(set) {
        let idsArr = '';
        set.forEach(function (item) {
            idsArr+=item+','
        });
        idsArr = '['+idsArr.substring(0,idsArr.length-1)+']';
        return idsArr;
    }
    function deleteCart() {
        let params = new URLSearchParams();
        let idsArr = toArray(ids);
        params.append('ids',idsArr);
        axios.post('/bb_wechat/public/cart/delete',params)
            .then(function (res) {
                if(res.data.code===200){
                    window.location.href = '/bb_wechat/public/index?sheet=3'
                }
            })
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
</html>