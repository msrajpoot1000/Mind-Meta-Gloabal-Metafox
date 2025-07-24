// show image when select from input
// document.addEventListener("DOMContentLoaded", function () {
//     const input = document.getElementById("photo1");
//     const preview = document.getElementById("image_preview1");

//     if (input && preview) {
//         input.addEventListener("change", function (event) {
//             const file = event.target.files[0];

//             if (file) {
//                 const reader = new FileReader();
//                 reader.onload = function (e) {
//                     preview.src = e.target.result;
//                     preview.style.display = "block";
//                 };
//                 reader.readAsDataURL(file);
//             } else {
//                 preview.src = "#";
//                 preview.style.display = "none";
//             }
//         });
//     }
// });

// document.addEventListener("DOMContentLoaded", function () {
//     document.querySelectorAll(".preview-image-input").forEach(function (input) {
//         const previewId = input.dataset.previewId;
//         const preview = document.getElementById(previewId);

//         if (preview) {
//             input.addEventListener("change", function (event) {
//                 const file = event.target.files[0];
//                 if (file) {
//                     const reader = new FileReader();
//                     reader.onload = function (e) {
//                         preview.src = e.target.result;
//                         preview.style.display = "block";
//                     };
//                     reader.readAsDataURL(file);
//                 } else {
//                     preview.src = "#";
//                     preview.style.display = "none";
//                 }
//             });
//         }
//     });
// });

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

document.addEventListener("DOMContentLoaded", function () {
    if (window.validationErrors && window.validationErrors.length > 0) {
        const toggleBtn = document.getElementById("toggleButton");
        if (toggleBtn) {
            toggleBtn.click();
        }
    }
});

// to mange image for delete
//  Image Preview on File Select
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".preview-image-input").forEach(function (input) {
        const inputName = input.name;
        const previewId = input.dataset.previewId;
        const preview = document.getElementById(previewId);
        const statusInput = document.querySelector(
            `input[name="status_${inputName}"]`
        );
        const deleteBtn = document.getElementById(
            `statusPhotoBtn_${inputName}`
        );

        if (!preview) return;

        // On file change: show preview and set status to 1
        input.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                    if (deleteBtn) deleteBtn.style.display = "inline-block";
                    if (statusInput) statusInput.value = 1;
                };
                reader.readAsDataURL(file);
            }
        });

        // On delete button click: hide preview, reset file input, set status to 0
        if (deleteBtn) {
            deleteBtn.addEventListener("click", function () {
                preview.src = "";
                preview.style.display = "none";
                input.value = ""; // clear file input
                if (statusInput) statusInput.value = 0;
                deleteBtn.style.display = "none";
            });
        }
    });
});

// delet button click logic

document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelectorAll("button[id^='statusPhotoBtn_']")
        .forEach(function (btn) {
            btn.addEventListener("click", function () {
                const name = this.id.replace("statusPhotoBtn_", "");

                const statusInput = document.getElementById(`status_${name}`);
                if (statusInput) {
                    statusInput.value = "0";
                }

                const imagePreview = document.getElementById(
                    `photo_preview_${name}`
                );
                if (imagePreview) {
                    imagePreview.src = "";
                    imagePreview.style.display = "none";
                }

                const fileInput = document.querySelector(
                    `input[name="${name}"]`
                );
                if (fileInput) {
                    fileInput.value = "";
                }

                this.style.display = "none";
            });
        });
});

// hide button if no image exits
document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelectorAll("img[id^='photo_preview_']")
        .forEach(function (img) {
            const name = img.id.replace("photo_preview_", "");
            const deleteBtn = document.getElementById(`statusPhotoBtn_${name}`);

            if (!deleteBtn) return;

            function checkImage() {
                if (img.complete && img.naturalWidth > 0) {
                    deleteBtn.style.display = "inline-block";
                } else {
                    deleteBtn.style.display = "none";
                }
            }

            if (img.complete) {
                checkImage();
            } else {
                img.onload = checkImage;
                img.onerror = checkImage;
            }
        });
});

// to set the default height of td in table
document.querySelectorAll("td").forEach((td) => {
    if (
        !td.querySelector("textarea") &&
        !td.querySelector("img") &&
        !td.querySelector("button") &&
        !td.querySelector("a")
    ) {
        const words = td.textContent.trim().split(/\s+/).slice(0, 3);
        td.textContent = words.join(" ") + (words.length < 2 ? "" : "...");
    }
});
