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

const form = document.getElementById("bookForm");
const saveButton = document.getElementById("save");

form && form.addEventListener("submit", function(event) {
    event.preventDefault();
    const publicationDateInput = document.getElementById("publicationDate");
    const selects = document.getElementsByClassName("form-select");
    const errorContainer = document.getElementById("publicationDateError");
    const publicationDateValue = publicationDateInput.value;
    let selectFlag = false;
    const pattern = /^[\u0590-\u05FF]+ \d{4}$/u;
    for( let i = 0; i < selects.length; i++){
        if(selects[i].value === "-1"){
            console.log(selects[i].value);
            errorContainer.innerHTML = errorContainer.innerHTML + `<span>${selects[i].name} is required</span>`;
            selectFlag = true;
        }
    }
    if (!pattern.test(publicationDateValue)) {
        const errorMessage = "<span>תאריך הוצאה חייב להיות בפורמט: חודש עברי ושנה (לדוגמה: אפריל 2016)</span>";
        errorContainer.innerHTML = errorContainer.innerHTML + errorMessage;
        return;
    }
    if(selectFlag) return;
    form.submit();
});