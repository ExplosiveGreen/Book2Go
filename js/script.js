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
            if (document.getElementsByName(`category`)[0]) {
                const option = document.createElement('option');
                option.value = category['cat_id'];
                option.innerText = category['cat_name'];
                document.getElementsByName(`category`)[0].appendChild(option);
            }
            document.querySelectorAll(`*[bs-category="${category['cat_id']}"]`)
                .forEach(card => card.innerText = card.innerText + category['cat_name']);
        });
    });
fetch('data/stations_status.json')
    .then(response => response.json())
    .then(data => {
        data.forEach(category => {
            if (document.getElementsByName(`stationStatus`)[0]) {
                const option = document.createElement('option');
                option.value = category['status_id'];
                option.innerText = category['status_name'];
                document.getElementsByName(`stationStatus`)[0].appendChild(option);
            }
            document.querySelectorAll(`*[bs-station="${category['status_id']}"]`)
                .forEach(card => card.innerText = card.innerText + category['status_name']);
        });
    });
fetch('data/conditions.json')
    .then(response => response.json())
    .then(data => {
        data.forEach(category => {
            const cond = document.getElementsByName(`condition`)[0];
            if (cond && category['reported_typed'].includes(cond.getAttribute('bs-role'))) {
                const option = document.createElement('option');
                option.value = category['condition_id'];
                option.innerText = category['condition_name'];
                cond.appendChild(option);
            }
            document.querySelectorAll(`*[bs-condition="${category['condition_id']}"]`)
                .forEach(card => card.innerText = card.innerText + category['condition_name']);
        });
    });
const form = document.getElementById("bookForm");

form && form.addEventListener("submit", function (event) {
    event.preventDefault();
    const publicationDateInput = document.getElementsByName("publicationDate")[0];
    const selects = document.getElementsByClassName("form-select");
    const errorContainer = document.getElementById("publicationDateError");
    const publicationDateValue = publicationDateInput.value;
    let selectFlag = false;
    const pattern = /^[\u0590-\u05FF]+ \d{4}$/u;
    for (let i = 0; i < selects.length; i++) {
        if (selects[i].value === "-1" && selects[i].disabled === false) {
            console.log(selects[i].value);
            errorContainer.innerHTML = errorContainer.innerHTML + `<span>${selects[i].name} is required</span>`;
            selectFlag = true;
        }
    }
    if (publicationDateInput.disabled == false && !pattern.test(publicationDateValue)) {
        const errorMessage = "<span>תאריך הוצאה חייב להיות בפורמט: חודש עברי ושנה (לדוגמה: אפריל 2016)</span>";
        errorContainer.innerHTML = errorContainer.innerHTML + errorMessage;
        return;
    }
    if (selectFlag) return;
    form.submit();
});

const stationForm = document.getElementById("stationForm");

stationForm && stationForm.addEventListener("submit", function (event) {
    event.preventDefault();
    const selects = document.getElementsByClassName("form-select");
    const errorContainer = document.getElementById("publicationDateError");
    let selectFlag = false;
    for (let i = 0; i < selects.length; i++) {
        if (selects[i].value === "-1" && selects[i].disabled === false) {
            errorContainer.innerHTML = errorContainer.innerHTML + `<span>${selects[i].name} is required</span>`;
            selectFlag = true;
        }
    }
    if (selectFlag) return;
    stationForm.submit();
});
document.getElementById("catFilter") && (
    document.getElementById("catFilter").onchange = function (e) {
        document.querySelectorAll("a.card").forEach(function (varCard) {
            varCard.style.display = "block";
            if (!varCard.querySelector("p[bs-category='" + e.target.value + "']"))
                varCard.style.display = "none";
        })
    })

document.getElementById("statusFilter") && (
    document.getElementById("statusFilter").onchange = function (e) {
        document.querySelectorAll("a.card").forEach(function (varCard) {
            varCard.style.display = "block";
            if (!varCard.querySelector("p[bs-station='" + e.target.value + "']"))
                varCard.style.display = "none";
        })
    })

// p[bs-category="+e.target.value+"]
function openImagePicker() {
    window.open('image_picker.php', 'Image Picker', 'width=800,height=600');
}

function setImage(imagePath) {
    var selectedImage = document.getElementById('bookImage');
    selectedImage.value = imagePath;
    var previewImage = document.getElementById('previewImage');
    previewImage.src = imagePath;
    previewImage.classList.remove('hidden');
}
function openImagePickerStations() {
    window.open('image_picker-stations.php', 'Image Picker', 'width=800,height=600');
}

function setImage(imagePath) {
    var selectedImage = document.getElementById('stationImage');
    selectedImage.value = imagePath;
    var previewImage = document.getElementById('previewImage');
    previewImage.src = imagePath;
    previewImage.classList.remove('hidden');
}
