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

  const conversations = [
    {
      id: 1,
      name: "Michael Chen",
      topic: "Soil Science",
      topicClass: "tag-soil-science",
      preview: "Thank you for the soil samples. Based on the pH levels, I recommend adjusting your fertilizer composition for the tomato plot...",
      time: "2m ago",
      status: "active",
      online: true,
      read: false,
      avatar: "https://randomuser.me/api/portraits/men/32.jpg",
      keywords: ["soil", "ph", "fertilizer", "tomato", "samples"]
    },
    {
      id: 2,
      name: "Emma Rodriguez",
      topic: "Pest Control",
      topicClass: "tag-pest-control",
      preview: "I've reviewed the photos you sent. Those are definitely aphids. Here's what I recommend for your chili and tomato plants...",
      time: "1h ago",
      status: "active",
      online: false,
      read: false,
      avatar: "https://randomuser.me/api/portraits/women/44.jpg",
      keywords: ["aphids", "pest", "chili", "tomato", "leaves"]
    },
    {
      id: 3,
      name: "James Wilson",
      topic: "Crop Rotation",
      topicClass: "tag-crop-rotation",
      preview: "Perfect! Your rotation plan looks excellent. This should improve soil health significantly and help your field recover next season...",
      time: "3h ago",
      status: "completed",
      online: false,
      read: true,
      avatar: "https://randomuser.me/api/portraits/men/45.jpg",
      keywords: ["rotation", "soil health", "field", "season", "corn"]
    },
    {
      id: 4,
      name: "Lisa Park",
      topic: "Irrigation",
      topicClass: "tag-irrigation",
      preview: "The drip irrigation system you mentioned would be perfect for your tomato field. It can help maintain consistent moisture...",
      time: "5h ago",
      status: "active",
      online: false,
      read: false,
      avatar: "https://randomuser.me/api/portraits/women/65.jpg",
      keywords: ["irrigation", "drip", "tomato", "water", "field"]
    },
    {
      id: 5,
      name: "Robert Thompson",
      topic: "Organic Farming",
      topicClass: "tag-organic-farming",
      preview: "You're welcome! Let me know how the organic fertilizer works out for your crops and whether the compost mix improves growth...",
      time: "1d ago",
      status: "completed",
      online: false,
      read: true,
      avatar: "https://randomuser.me/api/portraits/men/51.jpg",
      keywords: ["organic", "fertilizer", "compost", "crops", "growth"]
    },
    {
      id: 6,
      name: "Alicia Warren",
      topic: "Soil Science",
      topicClass: "tag-soil-science",
      preview: "For your lettuce bed, I suggest increasing organic matter and checking drainage. The soil looks slightly compacted from your description...",
      time: "2d ago",
      status: "active",
      online: true,
      read: false,
      avatar: "https://randomuser.me/api/portraits/women/21.jpg",
      keywords: ["lettuce", "soil", "organic matter", "drainage", "bed"]
    }
  ];

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

      card.innerHTML = `
        <div class="conversation-left">
          <div class="conversation-avatar">
            <img src="${item.avatar}" alt="${item.name}">
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
          <span class="read-check ${item.read ? "" : "hidden"}">
            <svg viewBox="0 0 24 24" fill="none">
              <path d="M7 12L10 15L17 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M3 12L6 15L13 8" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
          <span>${item.time}</span>
        </div>
      `;

      card.addEventListener("click", function () {
        alert(`Open conversation with ${item.name}`);
      });

      conversationList.appendChild(card);
    });
  }

  if (menuToggle) {
    menuToggle.addEventListener("click", function () {
      sidebar.classList.toggle("collapsed");
    });
  }

  conversationSearch.addEventListener("input", function (e) {
    currentSearch = e.target.value;
    renderConversations();
  });

  statusTabs.forEach((tab) => {
    tab.addEventListener("click", function () {
      statusTabs.forEach((item) => item.classList.remove("active"));
      this.classList.add("active");
      currentStatus = this.getAttribute("data-status");
      renderConversations();
    });
  });

  if (startConversationBtn) {
    startConversationBtn.addEventListener("click", function () {
      alert("Start new conversation clicked");
    });
  }

  renderConversations();
});