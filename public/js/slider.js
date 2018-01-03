let index = 1;
let timer;


function animate(offest){
    let list = document.getElementById('list');

    let newLeft = list.style.left + offest;
    list.style.left = newLeft + 'px';
    if (index >= 1) {
        list.style.left = -419 * (index - 1) + 'px';
    }
}

function play () {
    let list = document.getElementById('list');
    alert('-plau');
    let buttonItems = document.getElementById('buttons').getElementsByTagName('span');
    timer = setInterval(function () {
        index ++;
        if(index > 3) {
            index = 1;
        }
        animate(0);
        buttonShow();
    }, 2000);
}

function buttonShow () {
    let buttonItems = document.getElementById('buttons').getElementsByTagName('span');
    for (let i = 0; i < buttonItems.length; i++) {
        if (buttonItems[i].className === "on") {
            buttonItems[i].className = "";
        }
    }
    buttonItems[index - 1].className = "on";
}

play();


