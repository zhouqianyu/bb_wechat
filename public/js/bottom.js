
let indexPage = document.getElementById('index');
let sort = document.getElementById('sort');
let cart = document.getElementById('cart');
let me = document.getElementById('me');

indexPage.onclick = function () {
   window.location.href = '/bb_wechat/public/index?sheet=1';
};

sort.onclick = function () {
    window.location.href = '/bb_wechat/public/index?sheet=2';
};

cart.onclick = function () {
    window.location.href = '/bb_wechat/public/index?sheet=3';
};

me.onclick = function () {
    window.location.href = '/bb_wechat/public/index?sheet=4';
};