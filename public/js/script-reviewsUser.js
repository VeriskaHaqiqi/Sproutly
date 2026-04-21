document.addEventListener('DOMContentLoaded', function () {

  // ── Sidebar ───────────────────────────────────────────────────
  var menuToggle  = document.getElementById('menuToggle');
  var sidebar     = document.getElementById('sidebar');
  var mainContent = document.getElementById('mainContent');

  function openSidebar() {
    if (window.innerWidth <= 768) { sidebar.classList.add('show'); sidebar.classList.remove('closed'); }
    else { sidebar.classList.remove('closed'); mainContent.classList.add('shifted'); mainContent.classList.remove('full'); }
  }
  function closeSidebar() {
    sidebar.classList.add('closed'); sidebar.classList.remove('show');
    mainContent.classList.remove('shifted'); mainContent.classList.add('full');
  }
  function isSidebarOpen() {
    return window.innerWidth <= 768 ? sidebar.classList.contains('show') : !sidebar.classList.contains('closed');
  }
  menuToggle.addEventListener('click', function () { isSidebarOpen() ? closeSidebar() : openSidebar(); });
  document.querySelectorAll('.menu-link').forEach(function (l) { l.addEventListener('click', closeSidebar); });
  document.addEventListener('click', function (e) {
    if (window.innerWidth <= 768 && isSidebarOpen() && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) closeSidebar();
  });
  window.addEventListener('resize', function () {
    if (window.innerWidth > 768) sidebar.classList.remove('show');
    else { mainContent.classList.remove('shifted'); mainContent.classList.add('full'); }
  });

  // ── Data ─────────────────────────────────────────────────────
  // Completed reviews
  var reviewsData = [
    { id:1, expertName:"Dr. Marcus Thompson",  avatar:"https://randomuser.me/api/portraits/men/32.jpg",   specialty:"Crop Specialist",    consultation:"Tomato Disease Management",       rating:5, comment:"Dr. Thompson provided excellent guidance on identifying and treating early blight in my tomato crops. The follow-up advice was particularly helpful.", date:"March 15, 2026" },
    { id:2, expertName:"Sarah Chen",            avatar:"https://randomuser.me/api/portraits/women/44.jpg", specialty:"Irrigation Expert",  consultation:"Drip Irrigation Setup",           rating:4, comment:"Sarah helped me design an efficient drip irrigation system for my greenhouse. The water usage has decreased significantly while maintaining optimal plant health.", date:"March 8, 2026" },
    { id:3, expertName:"James Rodriguez",       avatar:"https://randomuser.me/api/portraits/men/22.jpg",   specialty:"Soil Scientist",     consultation:"Soil pH Balance",                 rating:5, comment:"James conducted a thorough soil analysis and provided detailed recommendations for improving pH levels. The step-by-step plan was easy to follow.", date:"February 28, 2026" },
    { id:4, expertName:"Dr. Emily Foster",      avatar:"https://randomuser.me/api/portraits/women/65.jpg", specialty:"Pest Control",       consultation:"Organic Pest Management",         rating:4, comment:"Dr. Foster introduced me to several organic pest control methods that have been very effective. Her knowledge of beneficial insects is impressive.", date:"February 20, 2026" },
    { id:5, expertName:"Michael Zhang",         avatar:"https://randomuser.me/api/portraits/men/55.jpg",   specialty:"Hydroponics",        consultation:"Nutrient Solution Optimization",  rating:5, comment:"Setting up a hydroponic tower seemed daunting until I spoke with Michael. He made the science of nutrient mixing very easy to understand.", date:"February 12, 2026" },
    { id:6, expertName:"Elena Rossi",           avatar:"https://randomuser.me/api/portraits/women/28.jpg", specialty:"Plant Disease",      consultation:"Rose Fungal Infection",           rating:3, comment:"The advice was solid, although I wish the response time was a bit faster. My roses are recovering slowly but steadily.", date:"February 5, 2026" },
  ];

  // Pending reviews (not yet reviewed)
  var pendingData = [
    { id:101, expertName:"Dr. Carlos Mendez",   avatar:"https://randomuser.me/api/portraits/men/45.jpg",   specialty:"Irrigation Expert",    consultation:"Drip Irrigation Design",      date:"Consulted on Apr 10, 2026" },
    { id:102, expertName:"Olivia Green",         avatar:"https://randomuser.me/api/portraits/women/54.jpg", specialty:"Organic Farming",      consultation:"Rainwater Harvesting Plan",    date:"Consulted on Apr 5, 2026"  },
    { id:103, expertName:"Dr. Tom Walker",       avatar:"https://randomuser.me/api/portraits/men/67.jpg",   specialty:"Crop Specialist",      consultation:"Cover Crop Strategy",         date:"Consulted on Mar 30, 2026" },
    { id:104, expertName:"Sophie Laurent",       avatar:"https://randomuser.me/api/portraits/women/33.jpg", specialty:"Plant Disease",        consultation:"Micronutrient Assessment",    date:"Consulted on Mar 25, 2026" },
  ];

  var itemsToShow = 4;
  var pendingDeleteId = null;
  var pendingRateId   = null;
  var selectedRating  = 0;
  var activeTab       = 'pending'; // 'pending' | 'completed'

  // ── DOM refs ─────────────────────────────────────────────────
  var searchInput    = document.getElementById('searchInput');
  var ratingFilter   = document.getElementById('ratingFilter');
  var categoryFilter = document.getElementById('categoryFilter');
  var loadMoreBtn    = document.getElementById('loadMoreBtn');
  var reviewsContainer = document.getElementById('reviewsContainer');
  var pendingContainer = document.getElementById('pendingContainer');
  var deleteModal    = document.getElementById('deleteModal');
  var rateModal      = document.getElementById('rateModal');
  var tabPending     = document.getElementById('tabPending');
  var tabCompleted   = document.getElementById('tabCompleted');
  var panelPending   = document.getElementById('panelPending');
  var panelCompleted = document.getElementById('panelCompleted');

  // ── TABS ─────────────────────────────────────────────────────
  tabPending.addEventListener('click', function () {
    activeTab = 'pending';
    tabPending.classList.add('active');
    tabCompleted.classList.remove('active');
    panelPending.style.display = '';
    panelCompleted.style.display = 'none';
    // hide rating/category filter for pending
    ratingFilter.parentElement.style.display = 'none';
    renderPending();
  });

  tabCompleted.addEventListener('click', function () {
    activeTab = 'completed';
    tabCompleted.classList.add('active');
    tabPending.classList.remove('active');
    panelPending.style.display = 'none';
    panelCompleted.style.display = '';
    ratingFilter.parentElement.style.display = '';
    renderReviews();
  });

  // ── Stars helper ─────────────────────────────────────────────
  function createStars(rating) {
    var html = '';
    for (var i = 1; i <= 5; i++) {
      var color = i <= rating ? '#fdcb6e' : '#dfe6e9';
      html += '<svg class="star" fill="' + color + '" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>';
    }
    return html;
  }

  // ── Render PENDING ────────────────────────────────────────────
  function renderPending() {
    var q = searchInput.value.toLowerCase();
    var filtered = pendingData.filter(function (r) {
      return !q || r.expertName.toLowerCase().includes(q) || r.consultation.toLowerCase().includes(q);
    });
    document.getElementById('pendingCount').textContent = pendingData.length;

    if (filtered.length === 0) {
      pendingContainer.innerHTML = '<div class="empty-state">No pending reviews found.</div>';
      return;
    }

    pendingContainer.innerHTML = '';
    filtered.forEach(function (r) {
      var card = document.createElement('div');
      card.className = 'pending-card';
      card.innerHTML =
        '<img src="' + r.avatar + '" class="pending-avatar" alt="' + r.expertName + '" onerror="this.src=\'https://ui-avatars.com/api/?name=' + encodeURIComponent(r.expertName) + '&background=76ead0&color=1a2636\'">' +
        '<div class="pending-info">' +
          '<div class="pending-name">' + r.expertName + '</div>' +
          '<span class="pending-specialty">' + r.specialty + '</span>' +
          '<div class="pending-topic">' + r.consultation + '</div>' +
        '</div>' +
        '<span class="pending-date">' + r.date + '</span>' +
        '<button class="rate-btn" data-id="' + r.id + '">Rate Now</button>';
      pendingContainer.appendChild(card);
    });

    pendingContainer.querySelectorAll('.rate-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = parseInt(this.getAttribute('data-id'));
        var item = pendingData.find(function (x) { return x.id === id; });
        if (!item) return;
        pendingRateId = id;
        selectedRating = 0;
        document.getElementById('rateConsultDate').textContent = item.date;
        document.getElementById('rateComment').value = '';
        updateStarPicker(0);
        rateModal.classList.remove('hidden');
      });
    });
  }

  // ── Render COMPLETED ──────────────────────────────────────────
  function renderReviews() {
    var query  = searchInput.value.toLowerCase();
    var rating = ratingFilter.value;
    var cat    = categoryFilter.value;

    var filtered = reviewsData.filter(function (r) {
      var ms = r.expertName.toLowerCase().includes(query) || r.consultation.toLowerCase().includes(query) || r.comment.toLowerCase().includes(query);
      var mr = rating === 'all' || r.rating == rating;
      var mc = cat === 'all' || r.specialty === cat;
      return (!query || ms) && mr && mc;
    });

    document.getElementById('completedCount').textContent = reviewsData.length;
    var display = filtered.slice(0, itemsToShow);
    reviewsContainer.innerHTML = '';

    if (display.length === 0) {
      reviewsContainer.innerHTML = '<div class="empty-state">No reviews matching your criteria found.</div>';
      loadMoreBtn.style.display = 'none';
      return;
    }

    display.forEach(function (r) {
      var card = document.createElement('div');
      card.className = 'review-card';
      card.innerHTML =
        '<div class="expert-meta">' +
          '<div class="exp-profile">' +
            '<img src="' + r.avatar + '" class="exp-avatar" alt="' + r.expertName + '" onerror="this.src=\'https://ui-avatars.com/api/?name=' + encodeURIComponent(r.expertName) + '&background=76ead0&color=1a2636\'">' +
            '<div class="exp-name-box"><h3>' + r.expertName + '</h3><span class="specialty-tag">' + r.specialty + '</span></div>' +
          '</div>' +
          '<p class="consult-title">Consultation: ' + r.consultation + '</p>' +
          '<div class="stars-row"><div class="star-group">' + createStars(r.rating) + '</div><span class="rating-score">' + r.rating + '.0</span></div>' +
        '</div>' +
        '<div class="review-content">' +
          '<p class="review-para">&ldquo;' + r.comment + '&rdquo;</p>' +
          '<div class="review-action">' +
            '<span class="date-text">' + r.date + '</span>' +
            '<button class="delete-btn" data-id="' + r.id + '">' +
              '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M3 6H21"/><path d="M8 6V4H16V6"/><path d="M19 6L18.2 19.1C18.1 20.2 17.1 21 16 21H8C6.9 21 5.9 20.2 5.8 19.1L5 6"/></svg>' +
              ' Delete Review' +
            '</button>' +
          '</div>' +
        '</div>';
      reviewsContainer.appendChild(card);
    });

    reviewsContainer.querySelectorAll('.delete-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var id = parseInt(this.getAttribute('data-id'));
        var review = reviewsData.find(function (r) { return r.id === id; });
        if (!review) return;
        pendingDeleteId = id;
        document.getElementById('deleteExpertName').textContent = review.expertName;
        deleteModal.classList.remove('hidden');
      });
    });

    loadMoreBtn.style.display = filtered.length > itemsToShow ? 'inline-block' : 'none';
  }

  // ── Star picker ───────────────────────────────────────────────
  function updateStarPicker(val) {
    document.querySelectorAll('.star-pick').forEach(function (btn) {
      var v = parseInt(btn.getAttribute('data-val'));
      btn.classList.toggle('active', v <= val);
    });
  }

  document.querySelectorAll('.star-pick').forEach(function (btn) {
    btn.addEventListener('mouseover', function () { updateStarPicker(parseInt(this.getAttribute('data-val'))); });
    btn.addEventListener('mouseout',  function () { updateStarPicker(selectedRating); });
    btn.addEventListener('click', function () {
      selectedRating = parseInt(this.getAttribute('data-val'));
      updateStarPicker(selectedRating);
    });
  });

  // ── Rate Modal ────────────────────────────────────────────────
  function closeRateModal() { rateModal.classList.add('hidden'); pendingRateId = null; }

  document.getElementById('rateNowBtn').addEventListener('click', function () {
    if (selectedRating === 0) {
      alert('Please select a star rating.');
      return;
    }
    var item = pendingData.find(function (x) { return x.id === pendingRateId; });
    if (!item) return;

    // Move from pending to completed
    reviewsData.unshift({
      id: Date.now(),
      expertName:   item.expertName,
      avatar:       item.avatar,
      specialty:    item.specialty,
      consultation: item.consultation,
      rating:       selectedRating,
      comment:      document.getElementById('rateComment').value.trim() || 'Great consultation experience!',
      date:         new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })
    });
    pendingData = pendingData.filter(function (x) { return x.id !== pendingRateId; });

    closeRateModal();
    // Switch to completed tab to show result
    tabCompleted.click();
  });

  document.getElementById('rateLaterBtn').addEventListener('click', closeRateModal);
  rateModal.addEventListener('click', function (e) { if (e.target === rateModal) closeRateModal(); });

  // ── Delete Modal ──────────────────────────────────────────────
  function closeDeleteModal() { deleteModal.classList.add('hidden'); pendingDeleteId = null; }
  document.getElementById('deleteCancelBtn').addEventListener('click', closeDeleteModal);
  deleteModal.addEventListener('click', function (e) { if (e.target === deleteModal) closeDeleteModal(); });
  document.getElementById('deleteConfirmBtn').addEventListener('click', function () {
    if (pendingDeleteId === null) return;
    reviewsData = reviewsData.filter(function (r) { return r.id !== pendingDeleteId; });
    closeDeleteModal();
    renderReviews();
  });

  // ── Filters ───────────────────────────────────────────────────
  loadMoreBtn.addEventListener('click', function () { itemsToShow = reviewsData.length; renderReviews(); });
  [searchInput, ratingFilter, categoryFilter].forEach(function (el) {
    el.addEventListener('input',  function () { itemsToShow = 4; activeTab === 'pending' ? renderPending() : renderReviews(); });
    el.addEventListener('change', function () { itemsToShow = 4; activeTab === 'pending' ? renderPending() : renderReviews(); });
  });

  // ── Init ─────────────────────────────────────────────────────
  ratingFilter.parentElement.style.display = 'none'; // hide rating filter on pending tab
  renderPending();
  renderReviews();
  updateCountBadges();

  function updateCountBadges() {
    document.getElementById('pendingCount').textContent   = pendingData.length;
    document.getElementById('completedCount').textContent = reviewsData.length;
  }
});