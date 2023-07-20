// window.addEventListener('resize', function(event) {
//     handaleHamburger(window.innerWidth);
// }, true);
// window.onload = function(event) {
//     handaleHamburger(window.innerWidth);
// };

// function handaleHamburger(size) {
//     if(size <= 1000) {
//         $('#hamburger').removeAttr('data-bs-toggle');
//         $('#hamburger').attr('data-bs-toggle','offcanvas');
//         $('#hamburgerNavigation').removeAttr('class');
//         $('#hamburgerNavigation').attr('class','w-50 hv65 offcanvas-end offcanvas');
//     }
//     else {
//         $('#hamburger').removeAttr('data-bs-toggle');
//         $('#hamburger').attr('data-bs-toggle','collapse');
//         $('#hamburgerNavigation').removeAttr('class');
//         $('#hamburgerNavigation').attr('class','w30 hv50 collapse show');
//     }
// }
function validateRegister() {
    var passwordInput = document.getElementById("password");

    var password = passwordInput.value.trim();

    if (password === "") {
      passwordInput.classList.add("is-invalid");
      document.getElementById("password-feedback").style.display = "block";
      return false;
    } else {
      passwordInput.classList.remove("is-invalid");
      document.getElementById("password-feedback").style.display = "none";
    }

    return true;
}
fetch('data/categories.json')
.then(response => response.json())
.then(data => {
    data.forEach(category => {
        document.querySelectorAll(`*[bs-category="${category['cat_id']}"]`)
        .forEach(card => card.innerText = card.innerText + category['cat_name']);
    });
});
fetch('data/stations_status.json')
.then(response => response.json())
.then(data => {
    data.forEach(category => {
        document.querySelectorAll(`*[bs-station="${category['status_id']}"]`)
        .forEach(card => card.innerText = card.innerText + category['status_name']);
    });
});
fetch('data/conditions.json')
.then(response => response.json())
.then(data => {
    data.forEach(category => {
        document.querySelectorAll(`*[bs-condition="${category['condition_id']}"]`)
        .forEach(card => card.innerText = card.innerText + category['condition_name']);
    });
});
const form = document.getElementById("bookForm");

form && form.addEventListener("submit", function(event) {
    event.preventDefault();
    const publicationDateInput = document.getElementsByName("publicationDate")[0];
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