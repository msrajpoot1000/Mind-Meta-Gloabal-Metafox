// show image when select from input
document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("photo1");
    const preview = document.getElementById("image_preview1");

    if (input && preview) {
        input.addEventListener("change", function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.style.display = "none";
            }
        });
    }
});

// for show the create section in pages by using button
const toggleBtn = document.getElementById("toggleButton");
const formSection = document.getElementById("create-form-section");

if (toggleBtn && formSection) {
    toggleBtn.addEventListener("click", function () {
        if (
            formSection.style.display === "none" ||
            formSection.style.display === ""
        ) {
            formSection.style.display = "block";
            toggleBtn.textContent = "Close Create";
        } else {
            formSection.style.display = "none";
            toggleBtn.textContent = "Create Blog";
        }
    });
}

// this is for password see or not see in login page
document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const toggleButton = document.getElementById("password-addon");
    const toggleIcon = document.getElementById("toggle-password-icon");

    if (passwordInput && toggleButton && toggleIcon) {
        toggleButton.addEventListener("click", function () {
            const isPassword = passwordInput.type === "password";
            console.log("Before toggle:", passwordInput.type); // DEBUG
            passwordInput.type = isPassword ? "text" : "password";
            console.log("After toggle:", passwordInput.type); // DEBUG

            toggleIcon.classList.toggle("mdi-eye-outline", !isPassword);
            toggleIcon.classList.toggle("mdi-eye-off-outline", isPassword);
        });
    }
});


// public/assets/js/additional.js
function hideDiv() {
    const el = document.getElementById("targetDiv");
    if (el) el.style.display = "none";
}
