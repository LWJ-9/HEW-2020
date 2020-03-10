


//! put likes into databases table by ajax
function pushtodb(elem) {
    if (elem.classList.contains('fas')) {
        var act = 'add';
    } else if (elem.classList.contains('far')) {
        var act = 'remove'
    }
    let pid = elem.closest('[id]').id;
    let ajax = new XMLHttpRequest();
    ajax.open(
        'POST',
        'ajax/pushLikesIntoDatabase.php'
    );
    ajax.onload = function () {
        console.log(ajax.responseText);
        let responData = ajax.responseText;
        renderLikedText(responData, pid);
    };
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.send(`pid=${pid}&act=${act}`);
}

function renderLikedText(responData, pid) {
    let elem = document.querySelector(`[id='${pid}'] .liked_text`);
    elem.innerHTML = responData;
    if (responData.length == 0) load_more.innerHTML = "no one liked yet";
}


$(document).ready(function () {
    //!load posts at main page by ajax
    let load_more = document.querySelector('.load_more');
    let offest = 5;
    let rows = 5;
    load_more.addEventListener("click", function (params) {
        const ajax = new XMLHttpRequest();

        ajax.open(
            'POST',
            'ajax/spreadroll.php',
        );

        ajax.onload = function () {
            console.log(ajax.responseText);
            let responData = ajax.responseText;
            renderHTML(responData);
        };

        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        ajax.send(`offest=${offest}&rows=${rows}`);
        offest += 5;
    });

    load_more.click();

    function renderHTML(responData) {

        if (responData.length == 0) load_more.innerHTML = "no more posts";
        else {
            let elem = document.createElement('div');
            elem.innerHTML = responData;
            load_more.insertAdjacentElement('beforebegin', elem);
        }
    }

});