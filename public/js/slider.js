let list = document.getElementById('list');
let buttonItems = document.getElementById('buttons').getElementsByTagName('span');
let index = 1;
let timer;


animate = (offest) => {
    let newLeft = list.style.left + offest;
    list.style.left = newLeft + 'px';
    if (index >= 1) {
        list.style.left = -419 * (index - 1) + 'px';
    }
};

play = () => {
    timer = setInterval(function () {
        index ++;
        if(index > 3) {
            index = 1;
        }
        animate(0);
        buttonShow();
    }, 2000);
};

buttonShow = () => {
    for (let i = 0; i < buttonItems.length; i++) {
        if (buttonItems[i].className === "on") {
            buttonItems[i].className = "";
        }
    }
    buttonItems[index - 1].className = "on";
};
play();