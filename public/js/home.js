let container, container2;

let posX, posY;

let width = window.innerWidth;

let height = window.innerHeight;

let div;

let span;

let timer;

let delayTimer = getDelayTimerValue();

let backgroundDelayTimer = getDelayTimerValue();

let backgroundClassName;

let currentBackgroundClassName = "bg-start";

let batsClassName;

let currentBatsClassName = "swirl";

window.onload = (event) => {

    container = document.getElementById("bats");

    container2 = document.getElementById("bats2");

    background = document.getElementById("background-container");

    container.classList.add("flyBy");

    createBats();
    createBats2();

    startAnimation();

    setTimeout(() => {

        batsFlying();

    }, 10000);

};

function createBats(){

    let numBats = 20;

    for(let i = 0; i < 10; i++)
    {

        div = document.createElement("div");

        div.classList.add("row");

        if(i > 0){

            let top = Math.random() * 10 + 1 + "%";

            div.style.top = top;

        }

        for(let j = 0; j < numBats; j++){

            span = document.createElement("span")

            span.classList.add("bat");

            span.setAttribute("id", "span" + j);

            span.style.width = (Math.random() * (100-30) + 30) + "px";

            span.style.height = (Math.random() * (100-30) + 30) + "px";

            span.style.marginTop = (Math.random() * (10-1) + 1) + "%";

            div.appendChild(span);

        }

        div.classList.add("flying");

        container.appendChild(div);

        if(numBats > 3){

            numBats = numBats - 2;

        }

    }

}

function createBats2(){

    let numBats = 20;

    let rot = 25;

    let divArray = [];

    for(let i = 0; i < 10; i++)
    {

        div = document.createElement("div");

        div.setAttribute("id", "span" + i);

        div.style.top = "-" + rot + "px";

        div.style.transform = "rotateX(" + rot + "deg) rotateY(" + rot + "deg)";

        rot += 25;

        for(let j = numBats; j > 0; j--){

            span = document.createElement("span")

            span.classList.add("bats-upside-down");

            span.setAttribute("id", "span" + j);

            span.style.width = "50px";

            span.style.height = "25px";

            let z = Math.random() * 500;

            span.style.transform = "translateZ(" + z + "px)";

            div.appendChild(span);

        }

        numBats = numBats - 2;

        if(numBats <=2 ){

            numBats = 2;

        }

        divArray.push(div);

    }

    for(let k = 0; k < divArray.length; k++){

        divArray[k].classList.add("row-version2");

        container2.appendChild(divArray[k]);

    }

}


function getBackgroundTimerValue(){

    let timerValue = Math.floor((Math.random() * (15000 - 10000)) + 10000);

    return timerValue;

}

function getDelayTimerValue(){

    let  timerValue= Math.floor((Math.random() * 10000) + 5000);

    return timerValue;

}


function startAnimation(){

    setTimeout(() => {

        showFigure();

    }, delayTimer);

}

function backgroundAnimation(){

    setTimeout(() => {

        showBatsAnimation();

    }, backgroundDelayTimer);


}

function batsFlying(){

    container.classList.remove("flyBy");

    container.classList.add("swirl");

    setTimeout(() => {

        showBatsAnimation();

    }, 15000);

}

function showBatsAnimation(){

    container.classList.remove(currentBatsClassName);

    container2.classList.add("hidden");

    let numImage = Math.floor(Math.random() * 6);

    // numImage = 2;

    if(numImage === 0 || numImage === 1){

        batsClassName = "background-flyby";

    }

    if(numImage === 2 || numImage === 4 || numImage === 6){

        let rand = Math.floor(Math.random() * 3);

        // rand = 0;

        if(rand === 0 || rand === 1)
        {

            container2.classList.remove("foreground-flyby");

            container2.classList.remove("hidden");

            addSpiral();

        }

        if(rand === 2){

            batsClassName = "swirl";

        }

    }

    if(numImage === 3 || numImage === 5){

        batsClassName = "background-flyover";

    }

    container.classList.add(batsClassName);

    currentBatsClassName = batsClassName;

    backgroundDelayTimer = getBackgroundTimerValue();

    backgroundAnimation();

}

function showFigure(){

    let numImage = Math.floor(Math.random() * 12);

    background.classList.remove(currentBackgroundClassName);

    if(numImage <= 2 || numImage === 11 || numImage === 12){

        backgroundClassName = "bg-start";

    }

    if(numImage > 2 && numImage <= 4){

        backgroundClassName = "bg-figure" + 1;

    }

    if(numImage > 4 && numImage <= 6){

        backgroundClassName = "bg-figure" + 2;

    }

    if(numImage > 6 && numImage <= 8){

        backgroundClassName = "bg-figure" + 3;

    }

    if(numImage > 8 && numImage <= 10){

        backgroundClassName = "bg-figure" + 4;

    }

    background.classList.add(backgroundClassName);

    currentBackgroundClassName = backgroundClassName;

    delayTimer = getDelayTimerValue();

    startAnimation();

}

function addSpiral(){

    let divs = container2.children;

    for(const child of divs){

        child.classList.add("spiral");

        setTimeout(() => {

            child.classList.remove("bats-upside-down");

            child.classList.remove("spiral");

            container2.classList.add("foreground-flyby");

        }, 3100);
    }
}