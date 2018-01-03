<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('css/search.css')}}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="header">
    <input type="text" placeholder="搜索" onchange="search(this)" autofocus>
    <span class="cancelText" onclick="toIndex()">取消</span>
</div>
<div class="main" id="main">
</div>
</body>
<script>
    let main = document.getElementsByClassName('main')[0];

    function search(obj) {
        let hint = obj.value;
        if (hint != '')
            axios.get('/bb_wechat/public/search?hint=' + hint)
                .then(function (res) {
                    let data = res.data;
                    if (data.code === 200) {
                        const childrens = main.children;
                        const length = childrens.length;
                        for(var i = 0;i<length;i++){
                            main.removeChild(childrens[0]);
                        }
                        data.data.forEach(function (item) {
                            let div = document.createElement('div');
                            div.className = 'mainItem';
                            div.innerHTML = item.name;
                            div.onclick = function () {
                                window.location.href = '/bb_wechat/public/detail?id=' + item.id;
                            };
                            main.appendChild(div)
                        })

                    }
                });
        else {
            const childrens = main.children;
            const length = childrens.length;
            for(var i = 0;i<length;i++){
                main.removeChild(childrens[0]);
            }
        }
    }
    function toIndex() {
        window.location.href = '/bb_wechat/public/index';
    }
</script>
</html>