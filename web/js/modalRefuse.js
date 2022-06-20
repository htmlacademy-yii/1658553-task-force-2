{
    let modal = document.getElementById('modalRefuse');
    let btn = document.getElementById('btnShowRefuse');
    let close = document.getElementById("formModalCloseRefuse");
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