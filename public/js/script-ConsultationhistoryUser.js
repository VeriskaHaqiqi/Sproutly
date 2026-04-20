const menuToggle  = document.getElementById("menuToggle");
const sidebar     = document.getElementById("sidebar");
const mainContent = document.getElementById("mainContent");

function openSidebar() {
  if (window.innerWidth <= 768) {
    sidebar.classList.add("show");
    sidebar.classList.remove("closed");
  } else {
    sidebar.classList.remove("closed");
    mainContent.classList.add("shifted");
    mainContent.classList.remove("full");
  }
}
function closeSidebar() {
  sidebar.classList.add("closed");
  sidebar.classList.remove("show");
  mainContent.classList.remove("shifted");
  mainContent.classList.add("full");
}
function isSidebarOpen() {
  if (window.innerWidth <= 768) return sidebar.classList.contains("show");
  return !sidebar.classList.contains("closed");
}

menuToggle.addEventListener("click", () => {
  isSidebarOpen() ? closeSidebar() : openSidebar();
});
document.addEventListener("click", (e) => {
  if (window.innerWidth <= 768 && isSidebarOpen() && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
    closeSidebar();
  }
});
window.addEventListener("resize", () => {
  if (window.innerWidth > 768) sidebar.classList.remove("show");
  else { mainContent.classList.remove("shifted"); mainContent.classList.add("full"); }
});

const conversations = [
  { id: 1, status: "active",    name: "Reza Firmansyah", tag: "Crop Science",       tagClass: "tag-soil-science",    avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=200&q=80", preview: "Reza: Morning, for watering you should do it before 9 AM...", time: "10:24", online: true,  unread: true,  url: "/roomChatUser" },
  { id: 2, status: "active",    name: "Siti Rahayu",     tag: "Soil Management",    tagClass: "tag-soil-science",    avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=200&q=80", preview: "Siti: Soil samples show low nitrogen. I recommend organic fertilizer...", time: "09:15", online: true,  unread: false, url: "/roomChatUser" },
  { id: 3, status: "active",    name: "Bagas Priyatno",  tag: "Pest Control",       tagClass: "tag-pest-control",    avatar: "https://images.unsplash.com/photo-1560250097-0b93528c311a?w=200&q=80", preview: "Bagas: The pest you mentioned is likely Spodoptera frugiperda...", time: "Yesterday", online: false, unread: true,  url: "/roomChatUser" },
  { id: 4, status: "completed", name: "Dewi Kusuma",     tag: "Organic Farming",    tagClass: "tag-organic-farming", avatar: "https://images.unsplash.com/photo-1504593811423-6dd665756598?w=200&q=80", preview: "Dewi: Great, your organic compost plan looks solid. Keep it up!", time: "Mar 10", online: false, unread: false, url: "/endedRoomUser" },
  { id: 5, status: "completed", name: "Hendra Wibowo",   tag: "Irrigation Systems", tagClass: "tag-irrigation",      avatar: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=200&q=80", preview: "Hendra: The drip irrigation plan has been sent to your email.", time: "Mar 5",  online: false, unread: false, url: "/endedRoomUser" },
];

let activeStatus  = "active";
let searchKeyword = "";

function renderConversations() {
  const list  = document.getElementById("conversationList");
  const empty = document.getElementById("emptyState");

  const filtered = conversations.filter(c =>
    c.status === activeStatus &&
    (!searchKeyword ||
      c.name.toLowerCase().includes(searchKeyword) ||
      c.tag.toLowerCase().includes(searchKeyword) ||
      c.preview.toLowerCase().includes(searchKeyword))
  );

  list.innerHTML = "";
  if (filtered.length === 0) { empty.classList.remove("hidden"); return; }
  empty.classList.add("hidden");

  filtered.forEach(c => {
    const div = document.createElement("div");
    div.className = "conversation-item";

    const onlineDot = c.online ? '<span class="online-dot"></span>' : "";
    const badge = c.status === "completed"
      ? `<span class="completed-badge"><svg width="11" height="11" viewBox="0 0 16 16" fill="none"><path d="M3 8L6.5 11.5L13 5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg> Ended</span>`
      : "";
    const check = c.unread ? "" : `<svg class="read-check" viewBox="0 0 24 24" fill="none"><path d="M2 12L7 17L14 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 17L16 9" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

    div.innerHTML = `
      <div class="conversation-left">
        <div class="conversation-avatar"><img src="${c.avatar}" alt="${c.name}"></div>
        <div class="conversation-main">
          <div class="conversation-name">${c.name}</div>
          <div class="conversation-meta-row">
            <span class="conversation-tag ${c.tagClass}">${c.tag}</span>
            ${onlineDot}${badge}
          </div>
          <div class="conversation-preview">${c.preview}</div>
        </div>
      </div>
      <div class="conversation-right">${check}<span>${c.time}</span></div>`;

    div.addEventListener("click", function () { window.location.href = c.url; });
    list.appendChild(div);
  });
}

document.getElementById("statusTabs").addEventListener("click", (e) => {
  const tab = e.target.closest(".status-tab");
  if (!tab) return;
  document.querySelectorAll(".status-tab").forEach(t => t.classList.remove("active"));
  tab.classList.add("active");
  activeStatus = tab.dataset.status;
  renderConversations();
});

document.getElementById("conversationSearch").addEventListener("input", (e) => {
  searchKeyword = e.target.value.trim().toLowerCase();
  renderConversations();
});

renderConversations();