const overlay = document.getElementById('overlay')

function closePopup(modal,overlay){
    modal.style.display = 'none'
    overlay.style.display = 'none'
}

function openPopup(modal,overlay){
    modal.style.display = 'block';
    overlay.style.display = 'block';
}

{
    const modal = document.getElementById('modalRefuse');
    const btn = document.getElementById('btnShowRefuse');
    const close = document.getElementById("formModalCloseRefuse");




    btn.onclick = function () {
        openPopup(modal,overlay);


    }
    close.onclick = function (){
        closePopup(modal,overlay);
    }



    }


{
    const modal = document.getElementById('modalDone');
    const btn = document.getElementById('btnShowDone');
    const close = document.getElementById("formModalCloseDone");




    btn.onclick = function () {
        openPopup(modal,overlay);

    }

    close.onclick = function () {
        closePopup(modal,overlay);

    }
}

{
    const modal = document.getElementById('modalResponse');
    const btn = document.getElementById('btnShowResponse');
    const close = document.getElementById("formModalCloseResponse");




    btn.onclick = function () {
        openPopup(modal,overlay);


    }

    close.onclick = function () {
        closePopup(modal,overlay);


    }
}



