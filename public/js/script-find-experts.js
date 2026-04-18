const menuToggle      = document.getElementById("menuToggle");
const sidebar         = document.getElementById("sidebar");
const mainContent     = document.getElementById("mainContent");
const dropdowns       = document.querySelectorAll(".dropdown");
const searchInput     = document.getElementById("expertSearch");
const minPriceInput   = document.getElementById("minPrice");
const maxPriceInput   = document.getElementById("maxPrice");
const applyPriceBtn   = document.getElementById("applyPriceBtn");
const resetFiltersBtn = document.getElementById("resetFiltersBtn");
const expertCards     = document.querySelectorAll(".expert-card");
const expertsGrid     = document.getElementById("expertsGrid");
const noResults       = document.getElementById("noResults");
const expertModal     = document.getElementById("expertModal");
const modalClose      = document.getElementById("modalClose");

let activeMinPrice = "";
let activeMaxPrice = "";

// ── Sidebar ────────────────────────────────────────────────
function openSidebar() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add("show"); sidebar.classList.remove("closed");
  } else {
    sidebar.classList.remove("closed");
    mainContent.classList.add("shifted"); mainContent.classList.remove("full");
  }
}
function closeSidebar() {
  sidebar.classList.add("closed"); sidebar.classList.remove("show");
  mainContent.classList.remove("shifted"); mainContent.classList.add("full");
}
function isSidebarOpen() {
  return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed");
}

menuToggle.addEventListener("click", () => isSidebarOpen() ? closeSidebar() : openSidebar());
document.querySelectorAll(".menu-link").forEach((l) => l.addEventListener("click", () => closeSidebar()));
document.addEventListener("click", (e) => {
  if (window.innerWidth <= 768 && isSidebarOpen() && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) closeSidebar();
});
window.addEventListener("resize", () => {
  if (window.innerWidth > 768) sidebar.classList.remove("show");
  else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
});

// ── Dropdowns ──────────────────────────────────────────────
dropdowns.forEach((dropdown) => {
  const button = dropdown.querySelector("button");
  button.addEventListener("click", (e) => {
    e.stopPropagation();
    dropdowns.forEach((d) => { if (d !== dropdown) d.classList.remove("open"); });
    dropdown.classList.toggle("open");
  });
  const menu = dropdown.querySelector(".dropdown-menu");
  if (menu) menu.addEventListener("click", (e) => e.stopPropagation());
});
document.addEventListener("click", () => dropdowns.forEach((d) => d.classList.remove("open")));

// ── Rupiah ─────────────────────────────────────────────────
function formatRupiahInput(value) {
  const digits = value.replace(/\D/g, "");
  return digits ? "Rp " + Number(digits).toLocaleString("id-ID") : "";
}
function parseRupiah(value) {
  const digits = value.replace(/\D/g, "");
  return digits ? Number(digits) : "";
}
minPriceInput.addEventListener("input", (e) => e.target.value = formatRupiahInput(e.target.value));
maxPriceInput.addEventListener("input", (e) => e.target.value = formatRupiahInput(e.target.value));

// ── Filter ─────────────────────────────────────────────────
function filterExperts() {
  const searchTerm      = searchInput.value.trim().toLowerCase();
  const specializations = [...document.querySelectorAll(".specialization-filter:checked")].map((el) => el.value);
  const minRating       = (document.querySelector(".rating-filter:checked") || {}).value || "";
  const minExperience   = (document.querySelector(".experience-filter:checked") || {}).value || "";
  const advanced        = [...document.querySelectorAll(".advanced-filter:checked")].map((el) => el.value);
  let visible = 0;

  expertCards.forEach((card) => {
    const ok =
      (!searchTerm || card.dataset.name.toLowerCase().includes(searchTerm) || card.dataset.specialization.toLowerCase().includes(searchTerm)) &&
      (specializations.length === 0 || specializations.includes(card.dataset.specialization)) &&
      (!minRating || Number(card.dataset.rating) >= Number(minRating)) &&
      (!minExperience || Number(card.dataset.experience) >= Number(minExperience)) &&
      (activeMinPrice === "" || Number(card.dataset.price) >= activeMinPrice) &&
      (activeMaxPrice === "" || Number(card.dataset.price) <= activeMaxPrice) &&
      (advanced.length === 0 || advanced.every((f) => {
        if (f === "online") return card.dataset.online === "true";
        if (f === "fast-response") return card.dataset["fastResponse"] === "true";
        if (f === "popular") return card.dataset.popular === "true";
        if (f === "indonesia") return card.dataset.indonesia === "true";
        return true;
      }));
    card.style.display = ok ? "block" : "none";
    if (ok) visible++;
  });

  expertsGrid.style.display = visible === 0 ? "none" : "grid";
  noResults.classList.toggle("hidden", visible !== 0);
}

searchInput.addEventListener("input", filterExperts);
document.querySelectorAll(".specialization-filter, .rating-filter, .experience-filter, .advanced-filter")
  .forEach((i) => i.addEventListener("change", filterExperts));

applyPriceBtn.addEventListener("click", () => {
  activeMinPrice = parseRupiah(minPriceInput.value);
  activeMaxPrice = parseRupiah(maxPriceInput.value);
  filterExperts();
  document.getElementById("priceDropdown").classList.remove("open");
});

resetFiltersBtn.addEventListener("click", () => {
  searchInput.value = ""; minPriceInput.value = ""; maxPriceInput.value = "";
  activeMinPrice = ""; activeMaxPrice = "";
  document.querySelectorAll(".specialization-filter, .rating-filter, .experience-filter, .advanced-filter")
    .forEach((i) => i.checked = false);
  filterExperts();
});

// ── Expert Modal ───────────────────────────────────────────
function openExpertModal(card) {
  const d = card.dataset;

  document.getElementById("modalAvatar").src   = d.avatar;
  document.getElementById("modalAvatar").alt   = d.name;
  document.getElementById("modalName").textContent         = d.name;
  document.getElementById("modalTitle").textContent        = d.title;
  document.getElementById("modalRating").innerHTML         = `⭐ ${d.rating}`;
  document.getElementById("modalSpec").textContent         = d.specialization;
  document.getElementById("modalLocation").textContent     = d.location;
  document.getElementById("modalUniversity").textContent   = d.university;
  document.getElementById("modalExperience").textContent   = `${d.experience} years experience`;
  document.getElementById("modalConsultations").textContent = `${d.consultations} consultations`;
  document.getElementById("modalBio").textContent          = d.bio;

  const price = Number(d.price).toLocaleString("id-ID");
  document.getElementById("modalPrice").textContent = `Rp${price}`;

  expertModal.classList.add("show");
  expertModal.setAttribute("aria-hidden", "false");
  document.body.style.overflow = "hidden";
}

function closeExpertModal() {
  expertModal.classList.remove("show");
  expertModal.setAttribute("aria-hidden", "true");
  document.body.style.overflow = "";
}

modalClose.addEventListener("click", closeExpertModal);
expertModal.addEventListener("click", (e) => { if (e.target === expertModal) closeExpertModal(); });
document.addEventListener("keydown", (e) => { if (e.key === "Escape") closeExpertModal(); });

filterExperts();