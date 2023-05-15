window.addEventListener('resize', function(event) {
    handaleHamburger(window.innerWidth);
}, true);
window.onload = function(event) {
    handaleHamburger(window.innerWidth);
};

function handaleHamburger(size) {
    if(size <= 1000) {
        $('#hamburger').removeAttr('data-bs-toggle');
        $('#hamburger').attr('data-bs-toggle','offcanvas');
        $('#hamburgerNavigation').removeAttr('class');
        $('#hamburgerNavigation').attr('class','w-50 h-50 offcanvas-end offcanvas');
    }
    else {
        $('#hamburger').removeAttr('data-bs-toggle');
        $('#hamburger').attr('data-bs-toggle','collapse');
        $('#hamburgerNavigation').removeAttr('class');
        $('#hamburgerNavigation').attr('class','w30 hv50 collapse show');
    }
}