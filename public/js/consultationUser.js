document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const menuToggle = document.getElementById("menuToggle");
  const conversationSearch = document.getElementById("conversationSearch");
  const statusTabs = document.querySelectorAll(".status-tab");
  const conversationList = document.getElementById("conversationList");
  const emptyState = document.getElementById("emptyState");
  const startConversationBtn = document.getElementById("startConversationBtn");

  let currentStatus = "active";
  let currentSearch = "";

  console.log('🚀 Consultation User page loaded!');

  // ── Real consultations from database ────────────────────────────
  const DB_CONSULTATIONS = window.DB_CONSULTATIONS || [];

  // Map DB consultations to the same shape as static entries
  const dbConversations = DB_CONSULTATIONS.map(function(c) {
    return {
      id:         c.id,
      name:       c.name,
      topic:      c.topic,
      topicClass: 'tag-' + c.topic.toLowerCase().replace(/\s+/g, '-'),
      preview:    c.preview,
      time:       c.time,
      status:     c.status,
      online:     c.online,
      read:       c.read,
      avatar:     c.avatar,
      initials:   c.initials,
      isDb:       true,
      keywords:   [c.name.toLowerCase(), c.topic.toLowerCase()]
    };
  });

  const conversations = [...dbConversations];

  function normalizeText(text) {
    return text.toLowerCase().trim();
  }

  function getFilteredConversations() {
    let filtered = [...conversations];

    filtered = filtered.filter((item) => item.status === currentStatus);

    if (currentSearch) {
      const keyword = normalizeText(currentSearch);

      filtered = filtered.filter((item) => {
        const inKeywords = item.keywords.some((k) =>
          normalizeText(k).includes(keyword)
        );

        return (
          normalizeText(item.name).includes(keyword) ||
          normalizeText(item.topic).includes(keyword) ||
          normalizeText(item.preview).includes(keyword) ||
          inKeywords
        );
      });
    }

    return filtered;
  }

  function renderConversations() {
    const filtered = getFilteredConversations();
    conversationList.innerHTML = "";

    if (filtered.length === 0) {
      emptyState.classList.remove("hidden");
      return;
    }

    emptyState.classList.add("hidden");

    filtered.forEach((item) => {
      const card = document.createElement("article");
      card.className = "conversation-item";

      // Avatar: show initials badge if no avatar URL
      const avatarHtml = item.avatar
        ? `<img src="${item.avatar}" alt="${item.name}" onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=width:100%;height:100%;background:linear-gradient(135deg,#76ead0,#76d7ea);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#155a4a;font-size:14px'>${item.initials || item.name.substring(0,2).toUpperCase()}</div>"`
        : `<div style="width:100%;height:100%;background:linear-gradient(135deg,#76ead0,#76d7ea);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;color:#155a4a;font-size:14px">${item.initials || item.name.substring(0,2).toUpperCase()}</div>`;

      card.innerHTML = `
        <div class="conversation-left">
          <div class="conversation-avatar">
            ${avatarHtml}
          </div>

          <div class="conversation-main">
            <h3 class="conversation-name">${item.name}</h3>
            <div class="conversation-meta-row">
              <span class="conversation-tag ${item.topicClass}">${item.topic}</span>
              ${item.online ? '<span class="online-dot"></span>' : ''}
            </div>
            <p class="conversation-preview">${item.preview}</p>
          </div>
        </div>

        <div class="conversation-right">
          <span class="read-check ${item.read ? '' : 'hidden'}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M7 12L10 15L17 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M3 12L6 15L13 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span>${item.time}</span>
        </div>
      `;

      card.addEventListener("click", function () {
        if (item.isDb) {
          // DB consultation: route with ID for correct room
          if (item.status === 'active') {
            window.location.href = '/roomChatUser?id=' + item.id;
          } else {
            window.location.href = '/ConsultationhistoryUser';
          }
        } else {
          // Static placeholder: generic navigation
          if (item.status === 'active') {
            window.location.href = '/roomChatUser';
          } else {
            window.location.href = '/ConsultationhistoryUser';
          }
        }
      });

      conversationList.appendChild(card);
    });
  }

  // ── SIDEBAR TOGGLE (FIXED) ──
  if (menuToggle) {
    menuToggle.addEventListener("click", function (e) {
      e.preventDefault();
      console.log('☰ Sidebar toggle clicked!');
      
      if (sidebar) {
        sidebar.classList.toggle("closed");
        sidebar.classList.toggle("show");
        console.log('Sidebar classes:', sidebar.className);
      }
      
      var mainContent = document.getElementById("mainContent");
      if (mainContent) {
        mainContent.classList.toggle("full");
        mainContent.classList.toggle("shifted");
        console.log('MainContent classes:', mainContent.className);
      }
    });
  } else {
    console.error('❌ menuToggle not found!');
  }

  // ── Close sidebar on outside click (mobile) ──
  document.addEventListener('click', function(e) {
    if (window.innerWidth <= 768) {
      if (sidebar && menuToggle && 
          !sidebar.contains(e.target) && 
          !menuToggle.contains(e.target)) {
        sidebar.classList.add('closed');
        sidebar.classList.remove('show');
        var mainContent = document.getElementById("mainContent");
        if (mainContent) {
          mainContent.classList.add('full');
          mainContent.classList.remove('shifted');
        }
      }
    }
  });

  // ── Handle window resize ──
  window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
      if (sidebar) {
        sidebar.classList.remove('show');
        sidebar.classList.remove('closed');
      }
      var mainContent = document.getElementById("mainContent");
      if (mainContent) {
        mainContent.classList.remove('full');
        mainContent.classList.add('shifted');
      }
    } else {
      var mainContent = document.getElementById("mainContent");
      if (mainContent) {
        mainContent.classList.remove('shifted');
        mainContent.classList.add('full');
      }
    }
  });

  // ── Search ──
  if (conversationSearch) {
    conversationSearch.addEventListener("input", function (e) {
      currentSearch = e.target.value;
      renderConversations();
    });
  }

  // ── Status Tabs ──
  statusTabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      statusTabs.forEach((item) => item.classList.remove("active"));
      this.classList.add("active");
      currentStatus = this.getAttribute("data-status");
      renderConversations();
    });
  });

  // ── Start Conversation ──
  if (startConversationBtn) {
    startConversationBtn.addEventListener("click", function () {
      window.location.href = '/find-experts';
    });
  }

  renderConversations();
  console.log('✅ Consultation User page ready!');
});