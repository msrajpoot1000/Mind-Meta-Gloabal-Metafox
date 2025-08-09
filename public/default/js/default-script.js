// to load country code
import { countryCodes } from "./countryCodes.js";
import { timezones } from "./timezones.js";

// Populate a select with given options
function populateSelect(selectEl, filteredList, defaultCode = "+91") {
    selectEl.innerHTML = "";
    filteredList.forEach(({ code, country }) => {
        const option = document.createElement("option");
        option.value = `${code} ${country}`;
        option.textContent = `${code} ${country}`;
        if (code === defaultCode) option.selected = true;
        selectEl.appendChild(option);
    });
}

// Initialize all pairs
document.addEventListener("DOMContentLoaded", () => {
    let i = 1;

    while (true) {
        const input = document.getElementById(`countrySearch${i}`);
        const select = document.querySelector(`.country-code${i}`);

        if (!input || !select) break; // stop if no more pairs

        // Populate initially
        populateSelect(select, countryCodes);

        // On search
        input.addEventListener("input", () => {
            const keyword = input.value.toLowerCase();
            const filtered = countryCodes.filter(({ code, country }) =>
                `${code} ${country}`.toLowerCase().includes(keyword)
            );
            populateSelect(select, filtered);
        });

        i++;
    }
});

// to set read and read more
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".toggle-btn-read-more").forEach((button) => {
        const targetClass = button.getAttribute("data-target");
        const para = document.querySelector("." + targetClass);
        const lines = parseInt(para.getAttribute("data-lines")) || 3;

        // Set initial styles
        para.style.display = "-webkit-box";
        para.style.webkitBoxOrient = "vertical";
        para.style.overflow = "hidden";
        para.style.webkitLineClamp = lines;

        // Check if "Read More" is needed
        const fullHeightCheck = () => {
            para.style.webkitLineClamp = "unset";
            const fullHeight = para.getBoundingClientRect().height;
            para.style.webkitLineClamp = lines;
            const limitedHeight = para.getBoundingClientRect().height;
            return fullHeight > limitedHeight + 1;
        };

        if (!fullHeightCheck()) {
            button.style.display = "none";
        }

        // Toggle expand/collapse
        button.addEventListener("click", function (e) {
            e.preventDefault();
            const isExpanded = para.classList.toggle("expanded");
            if (isExpanded) {
                para.style.webkitLineClamp = "unset";
                button.textContent = "Read Less";
            } else {
                para.style.webkitLineClamp = lines;
                button.textContent = "Read More";
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Add tick icons before each li
    const tickLists = document.querySelectorAll(".putTickBeforeLi ul li");

    tickLists.forEach(function (li) {
        if (!li.querySelector(".round-tick-icon")) {
            const icon = document.createElement("i");
            icon.className = "fas fa-check round-tick-icon";
            li.prepend(icon);
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const timezoneSelect = document.getElementById("timezone");

    if (!timezoneSelect) {
        // Element not found, just exit
        return;
    }

    timezones.forEach((tz) => {
        const option = document.createElement("option");
        option.value = `${tz.name} (${tz.offset})`;
        option.textContent = `${tz.name} (${tz.offset})`;
        timezoneSelect.appendChild(option);
    });
});

