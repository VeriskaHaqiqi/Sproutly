// ── Sidebar ──────────────────────────────────────────────────
const menuToggle  = document.getElementById("menuToggle");
const sidebar     = document.getElementById("sidebar");
const mainContent = document.getElementById("mainContent");

function openSidebar() {
  if (window.innerWidth <= 768) { sidebar.classList.add("show"); sidebar.classList.remove("closed"); }
  else { sidebar.classList.remove("closed"); mainContent.classList.add("shifted"); mainContent.classList.remove("full"); }
}
function closeSidebar() {
  sidebar.classList.add("closed"); sidebar.classList.remove("show");
  mainContent.classList.remove("shifted"); mainContent.classList.add("full");
}
function isSidebarOpen() {
  return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed");
}
menuToggle.addEventListener("click", () => isSidebarOpen() ? closeSidebar() : openSidebar());
document.addEventListener("click", (e) => {
  if (window.innerWidth <= 768 && isSidebarOpen() && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) closeSidebar();
});
window.addEventListener("resize", () => {
  if (window.innerWidth > 768) sidebar.classList.remove("show");
  else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
});

// ── Filter panel ─────────────────────────────────────────────
document.getElementById("filterToggle").addEventListener("click", () => {
  document.getElementById("filterPanel").classList.toggle("hidden");
});
document.getElementById("filterReset").addEventListener("click", () => {
  document.getElementById("filterStatus").value = "";
  document.getElementById("filterSearch").value = "";
  currentPage = 1;
  renderTable();
});
document.getElementById("filterStatus").addEventListener("change", () => { currentPage = 1; renderTable(); });
document.getElementById("filterSearch").addEventListener("input",  () => { currentPage = 1; renderTable(); });

// ── Data ─────────────────────────────────────────────────────
const invoices = [
  { id:"#INV-001", expert:"Dr. Sarah Johnson",  role:"Crop Specialist",         avatar:"https://randomuser.me/api/portraits/women/44.jpg",  consultation:"Tomato Disease Analysis",        amount:"$450", due:"Dec 15, 2024", status:"Paid"    },
  { id:"#INV-002", expert:"Michael Chen",        role:"Soil Expert",             avatar:"https://randomuser.me/api/portraits/men/32.jpg",    consultation:"Soil pH Assessment",             amount:"$320", due:"Dec 20, 2024", status:"Paid"    },
  { id:"#INV-003", expert:"Emily Rodriguez",     role:"Irrigation Consultant",   avatar:"https://randomuser.me/api/portraits/women/65.jpg",  consultation:"Water Management Plan",          amount:"$680", due:"Dec 10, 2024", status:"Refund"  },
  { id:"#INV-004", expert:"David Park",          role:"Pest Control Expert",     avatar:"https://randomuser.me/api/portraits/men/55.jpg",    consultation:"Integrated Pest Management",     amount:"$520", due:"Dec 25, 2024", status:"Paid"    },
  { id:"#INV-005", expert:"Lisa Thompson",       role:"Organic Farming Expert",  avatar:"https://randomuser.me/api/portraits/women/28.jpg",  consultation:"Organic Certification Guidance", amount:"$750", due:"Jan 5, 2025",  status:"Refund"  },
  { id:"#INV-006", expert:"James Wilson",        role:"Climate Agronomist",      avatar:"https://randomuser.me/api/portraits/men/11.jpg",    consultation:"Climate-Smart Practices",        amount:"$410", due:"Jan 10, 2025", status:"Paid"    },
  { id:"#INV-007", expert:"Alicia Warren",       role:"Urban Farming Specialist",avatar:"https://randomuser.me/api/portraits/women/51.jpg",  consultation:"Hydroponic System Setup",        amount:"$890", due:"Jan 12, 2025", status:"Pending" },
  { id:"#INV-008", expert:"Robert Martinez",     role:"Soil Fertility Agronomist",avatar:"https://randomuser.me/api/portraits/men/22.jpg",  consultation:"Nutrient Management Plan",       amount:"$370", due:"Jan 15, 2025", status:"Paid"    },
  { id:"#INV-009", expert:"Olivia Green",        role:"Water Resource Consultant",avatar:"https://randomuser.me/api/portraits/women/54.jpg", consultation:"Rainwater Harvesting Plan",      amount:"$460", due:"Jan 18, 2025", status:"Pending" },
  { id:"#INV-010", expert:"Carlos Mendez",       role:"Irrigation Engineer",     avatar:"https://randomuser.me/api/portraits/men/45.jpg",    consultation:"Drip Irrigation Design",         amount:"$610", due:"Jan 20, 2025", status:"Paid"    },
  { id:"#INV-011", expert:"Sophie Laurent",      role:"Plant Nutrition Expert",  avatar:"https://randomuser.me/api/portraits/women/33.jpg",  consultation:"Micronutrient Assessment",       amount:"$280", due:"Jan 22, 2025", status:"Pending" },
  { id:"#INV-012", expert:"Tom Walker",          role:"Agroforestry Specialist", avatar:"https://randomuser.me/api/portraits/men/67.jpg",    consultation:"Cover Crop Strategy",            amount:"$340", due:"Jan 25, 2025", status:"Paid"    },
];

const PER_PAGE = 5;
let currentPage = 1;

function getFiltered() {
  const status = document.getElementById("filterStatus").value;
  const search = document.getElementById("filterSearch").value.trim().toLowerCase();
  return invoices.filter(inv => {
    const matchStatus = !status || inv.status === status;
    const matchSearch = !search || inv.expert.toLowerCase().includes(search) || inv.consultation.toLowerCase().includes(search) || inv.id.toLowerCase().includes(search);
    return matchStatus && matchSearch;
  });
}

function badgeClass(status) {
  return { Paid:"badge-paid", Pending:"badge-pending", Refund:"badge-refund" }[status] || "badge-pending";
}

function renderTable() {
  const filtered   = getFiltered();
  const totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
  if (currentPage > totalPages) currentPage = 1;
  const start = (currentPage - 1) * PER_PAGE;
  const items = filtered.slice(start, start + PER_PAGE);

  const tbody = document.getElementById("invoiceTableBody");
  if (items.length === 0) {
    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:36px;color:#9aaa9e;font-size:14px;">No invoices found.</td></tr>`;
  } else {
    tbody.innerHTML = items.map(inv => `
      <tr>
        <td style="font-weight:700;color:#2b6cb0;font-size:13.5px;">${inv.id}</td>
        <td>
          <div class="expert-cell">
            <img src="${inv.avatar}" alt="${inv.expert}" class="expert-avatar" onerror="this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(inv.expert)}&background=76ead0&color=1a2636'">
            <div>
              <div class="expert-cell-name">${inv.expert}</div>
              <div class="expert-cell-role">${inv.role}</div>
            </div>
          </div>
        </td>
        <td>${inv.consultation}</td>
        <td style="font-weight:700;">${inv.amount}</td>
        <td style="color:#7a8e9a;">${inv.due}</td>
        <td><span class="badge ${badgeClass(inv.status)}">${inv.status}</span></td>
        <td>
          <button class="action-btn" title="Download invoice">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
              <polyline points="7 10 12 15 17 10"/>
              <line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
          </button>
        </td>
      </tr>`).join("");
  }

  // Showing text
  const total = filtered.length;
  const from  = total === 0 ? 0 : start + 1;
  const to    = Math.min(start + PER_PAGE, total);
  document.getElementById("showingText").textContent = `Showing ${from} to ${to} of ${total} results`;

  renderPagination(totalPages);
}

function renderPagination(totalPages) {
  const wrap = document.getElementById("pagination");
  wrap.innerHTML = "";

  const prevBtn = document.createElement("button");
  prevBtn.className = "page-btn page-btn-text";
  prevBtn.textContent = "Previous";
  prevBtn.disabled = currentPage === 1;
  prevBtn.addEventListener("click", () => { currentPage--; renderTable(); });
  wrap.appendChild(prevBtn);

  const maxVisible = 3;
  for (let i = 1; i <= totalPages; i++) {
    if (totalPages > maxVisible + 2) {
      if (i !== 1 && i !== totalPages && Math.abs(i - currentPage) > 1) {
        if (i === 2 || i === totalPages - 1) { const d = document.createElement("span"); d.textContent = "..."; d.style.cssText = "padding:0 4px;color:#9aaa9e;font-size:13px;"; wrap.appendChild(d); }
        continue;
      }
    }
    const btn = document.createElement("button");
    btn.className = "page-btn" + (i === currentPage ? " active" : "");
    btn.textContent = i;
    btn.addEventListener("click", () => { currentPage = i; renderTable(); });
    wrap.appendChild(btn);
  }

  const nextBtn = document.createElement("button");
  nextBtn.className = "page-btn page-btn-text";
  nextBtn.textContent = "Next";
  nextBtn.disabled = currentPage === totalPages;
  nextBtn.addEventListener("click", () => { currentPage++; renderTable(); });
  wrap.appendChild(nextBtn);
}

renderTable();