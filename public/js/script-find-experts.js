const dropdowns = document.querySelectorAll(".dropdown");
const searchInput = document.getElementById("expertSearch");
const minPriceInput = document.getElementById("minPrice");
const maxPriceInput = document.getElementById("maxPrice");
const applyPriceBtn = document.getElementById("applyPriceBtn");
const resetFiltersBtn = document.getElementById("resetFiltersBtn");
const expertCards = document.querySelectorAll(".expert-card");
const expertsGrid = document.getElementById("expertsGrid");
const noResults = document.getElementById("noResults");

let activeMinPrice = "";
let activeMaxPrice = "";

/* Dropdown toggle */
dropdowns.forEach((dropdown) => {
  const button = dropdown.querySelector("button");

  button.addEventListener("click", (event) => {
    event.stopPropagation();

    dropdowns.forEach((item) => {
      if (item !== dropdown) item.classList.remove("open");
    });

    dropdown.classList.toggle("open");
  });

  const menu = dropdown.querySelector(".dropdown-menu");
  if (menu) {
    menu.addEventListener("click", (event) => {
      event.stopPropagation();
    });
  }
});

document.addEventListener("click", () => {
  dropdowns.forEach((dropdown) => dropdown.classList.remove("open"));
});

/* Rupiah formatter */
function formatRupiahInput(value) {
  const digits = value.replace(/\D/g, "");
  if (!digits) return "";
  return "Rp " + Number(digits).toLocaleString("id-ID");
}

function parseRupiah(value) {
  const digits = value.replace(/\D/g, "");
  return digits ? Number(digits) : "";
}

minPriceInput.addEventListener("input", (e) => {
  e.target.value = formatRupiahInput(e.target.value);
});

maxPriceInput.addEventListener("input", (e) => {
  e.target.value = formatRupiahInput(e.target.value);
});

/* Filters */
function getSelectedSpecializations() {
  return [...document.querySelectorAll(".specialization-filter:checked")].map((el) => el.value);
}

function getSelectedRating() {
  const selected = document.querySelector(".rating-filter:checked");
  return selected ? selected.value : "";
}

function getSelectedExperience() {
  const selected = document.querySelector(".experience-filter:checked");
  return selected ? selected.value : "";
}

function getAdvancedFilters() {
  return [...document.querySelectorAll(".advanced-filter:checked")].map((el) => el.value);
}

function filterExperts() {
  const searchTerm = searchInput.value.trim().toLowerCase();
  const specializations = getSelectedSpecializations();
  const minRating = getSelectedRating();
  const minExperience = getSelectedExperience();
  const advancedFilters = getAdvancedFilters();

  let visibleCount = 0;

  expertCards.forEach((card) => {
    const name = card.dataset.name.toLowerCase();
    const specialization = card.dataset.specialization;
    const rating = Number(card.dataset.rating);
    const experience = Number(card.dataset.experience);
    const price = Number(card.dataset.price);

    const isOnline = card.dataset.online === "true";
    const isFastResponse = card.dataset["fastResponse"] === "true";
    const isPopular = card.dataset.popular === "true";
    const isIndonesia = card.dataset.indonesia === "true";

    const matchesSearch =
      !searchTerm ||
      name.includes(searchTerm) ||
      specialization.toLowerCase().includes(searchTerm);

    const matchesSpecialization =
      specializations.length === 0 || specializations.includes(specialization);

    const matchesRating =
      !minRating || rating >= Number(minRating);

    const matchesExperience =
      !minExperience || experience >= Number(minExperience);

    const matchesMinPrice =
      activeMinPrice === "" || price >= activeMinPrice;

    const matchesMaxPrice =
      activeMaxPrice === "" || price <= activeMaxPrice;

    const matchesAdvanced =
      (advancedFilters.length === 0) ||
      advancedFilters.every((filter) => {
        if (filter === "online") return isOnline;
        if (filter === "fast-response") return isFastResponse;
        if (filter === "popular") return isPopular;
        if (filter === "indonesia") return isIndonesia;
        return true;
      });

    const isVisible =
      matchesSearch &&
      matchesSpecialization &&
      matchesRating &&
      matchesExperience &&
      matchesMinPrice &&
      matchesMaxPrice &&
      matchesAdvanced;

    card.style.display = isVisible ? "block" : "none";

    if (isVisible) visibleCount++;
  });

  if (visibleCount === 0) {
    expertsGrid.style.display = "none";
    noResults.classList.remove("hidden");
  } else {
    expertsGrid.style.display = "grid";
    noResults.classList.add("hidden");
  }
}

/* Auto filter */
searchInput.addEventListener("input", filterExperts);

document.querySelectorAll(".specialization-filter").forEach((input) => {
  input.addEventListener("change", filterExperts);
});

document.querySelectorAll(".rating-filter").forEach((input) => {
  input.addEventListener("change", filterExperts);
});

document.querySelectorAll(".experience-filter").forEach((input) => {
  input.addEventListener("change", filterExperts);
});

document.querySelectorAll(".advanced-filter").forEach((input) => {
  input.addEventListener("change", filterExperts);
});

applyPriceBtn.addEventListener("click", () => {
  activeMinPrice = parseRupiah(minPriceInput.value);
  activeMaxPrice = parseRupiah(maxPriceInput.value);
  filterExperts();
  document.getElementById("priceDropdown").classList.remove("open");
});

resetFiltersBtn.addEventListener("click", () => {
  searchInput.value = "";
  minPriceInput.value = "";
  maxPriceInput.value = "";
  activeMinPrice = "";
  activeMaxPrice = "";

  document.querySelectorAll(".specialization-filter").forEach((input) => {
    input.checked = false;
  });

  document.querySelectorAll(".rating-filter").forEach((input) => {
    input.checked = false;
  });

  document.querySelectorAll(".experience-filter").forEach((input) => {
    input.checked = false;
  });

  document.querySelectorAll(".advanced-filter").forEach((input) => {
    input.checked = false;
  });

  filterExperts();
});

/* init */
filterExperts();