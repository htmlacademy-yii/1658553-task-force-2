{
    let modal = document.getElementById('modalResponse');
    let btn = document.getElementById('btnClose');
    let close = document.getElementById("formModalClose");
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
