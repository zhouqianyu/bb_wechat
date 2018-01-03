<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/receiveAddressManage.css')}}">
    <title>管理收货地址</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
<div class="main" id="main">
    @foreach($data as $k => $v)
        <div class="mainItem" key="{{$v['id']}}" onclick="choiceOne(this)">
            <div class="mainItemTop">
                <div>
                    <span>{{$v['name']}}</span>
                    <span>{{$v['address']}}</span>
                </div>
                <span class="mainItemRight">
                    {{$v['phone']}}
                </span>
            </div>
            <div class="mainItemBottom">
                <span class="mainItemRight" key="{{$v['id']}}" onclick="deleteAddress(this)" >删除</span>
            </div>
        </div>
    @endforeach
</div>
<div class="bottom" onclick="toAdd()">
    添加新地址
</div>
<script>
    function toAdd() {
        window.location.href = '/bb_wechat/public/addAddress';
    }
    function deleteAddress(obj) {
        let id = obj.getAttribute('key');
        let params = new URLSearchParams();
        params.append('id',id);
        axios.post('/bb_wechat/public/deleteAddressData',params)
            .then(function (res) {
                if (res.data.code === 200){
                    window.location.href = '/bb_wechat/public/choiceAddress';
                }
            });
    }
    function choiceOne(obj) {
        let id = obj.getAttribute('key');
        let billId = window.localStorage.getItem('id');
        window.location.href = '/bb_wechat/public/waitPay?address_id='+id+'&id='+billId;
    }
</script>
</body>
</html>