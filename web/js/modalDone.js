{
    let modal = document.getElementById('modalDone');
    let btn = document.getElementById('btnShowDone');
    let close = document.getElementById("formModalCloseDone");
    let overlay = document.getElementsByClassName("overlay")[0]


    btn.onclick = function () {
        modal.style.display = 'block';
        overlay.style.display = 'block';


    }

    close.onclick = function () {
        modal.style.display = 'none';
        overlay.style.display = 'none';


    }
}