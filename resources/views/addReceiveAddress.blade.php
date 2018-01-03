<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/addReceiveAddress.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>添加新地址</title>
</head>
<body>
    <div class="header">
        <span onclick="save()">保存</span>
    </div>
    <div class="main">
        <div class="mainItem">
            <span>收货人:</span>
            <input type="text" id="name">
        </div>
        <div class="mainItem">
            <span>联系电话:</span>
            <input type="tel" id="tel">
        </div>
        <div class="mainBottom">
            <textarea placeholder="详细地址" id="address"></textarea>
        </div>
    </div>
</body>
<script>
    function save() {
        let name = document.getElementById('name').value;
        let tel = document.getElementById('tel').value;
        let address = document.getElementById('address').value;
        let params = new URLSearchParams();
        params.append('name',name);
        params.append('tel',tel);
        params.append('address',address);
        axios.post('/bb_wechat/public/addAddressData',params)
            .then(function (res) {
                if (res.data.code === 200){
                    window.location.href = '/bb_wechat/public/choiceAddress'
                }
            });
    }
</script>
</html>