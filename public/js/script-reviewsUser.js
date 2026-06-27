// ============================================================
// script-reviewsUser.js - Halaman Reviews User
// ============================================================

var allReviews = [];
var currentPage = 1;
var PER_PAGE = 4;
var currentTab = 'pending'; // 'pending' atau 'completed'

// ──────────────────────────────────────────────────────────────
// FETCH DATA
// ──────────────────────────────────────────────────────────────
function fetchReviews() {
    console.log('🔄 Fetching reviews...');
    
    fetch('/reviews-data', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(function(res) {
        if (!res.ok) {
            throw new Error('HTTP error! status: ' + res.status);
        }
        return res.json();
    })
    .then(function(data) {
        console.log('✅ Data received:', data);
        
        // Pastikan data adalah array
        if (!Array.isArray(data)) {
            if (data && typeof data === 'object') {
                data = [data];
            } else {
                data = [];
            }
        }
        
        allReviews = data;
        console.log('✅ allReviews:', allReviews);
        console.log('✅ Jumlah data:', allReviews.length);
        
        renderReviews();
        updateBadges();
    })
    .catch(function(err) {
        console.error('❌ Failed to fetch reviews:', err);
        allReviews = [];
        renderReviews();
    });
}

// ──────────────────────────────────────────────────────────────
// UPDATE BADGES
// ──────────────────────────────────────────────────────────────
function updateBadges() {
    var pendingCount = allReviews.filter(function(r) { return r.can_review; }).length;
    var completedCount = allReviews.filter(function(r) { return r.has_reviewed; }).length;
    
    var pendingBadge = document.getElementById('pendingCount');
    var completedBadge = document.getElementById('completedCount');
    
    if (pendingBadge) pendingBadge.textContent = pendingCount;
    if (completedBadge) completedBadge.textContent = completedCount;
}

// ──────────────────────────────────────────────────────────────
// RENDER REVIEWS
// ──────────────────────────────────────────────────────────────
function renderReviews() {
    console.log('🔄 Rendering reviews...');
    
    // Filter berdasarkan tab yang aktif
    var filtered = allReviews;
    if (currentTab === 'pending') {
        filtered = allReviews.filter(function(r) { return r.can_review; });
    } else if (currentTab === 'completed') {
        filtered = allReviews.filter(function(r) { return r.has_reviewed; });
    }
    
    // Search filter
    var searchInput = document.getElementById('searchInput');
    var keyword = searchInput ? searchInput.value.trim().toLowerCase() : '';
    if (keyword) {
        filtered = filtered.filter(function(r) {
            return (r.expert_name && r.expert_name.toLowerCase().includes(keyword)) || 
                   (r.consultation_topic && r.consultation_topic.toLowerCase().includes(keyword));
        });
    }
    
    // Rating filter
    var ratingFilter = document.getElementById('ratingFilter');
    var ratingVal = ratingFilter ? ratingFilter.value : 'all';
    if (ratingVal !== 'all') {
        filtered = filtered.filter(function(r) { 
            return r.rating_value == ratingVal; 
        });
    }
    
    // Category filter
    var categoryFilter = document.getElementById('categoryFilter');
    var categoryVal = categoryFilter ? categoryFilter.value : 'all';
    if (categoryVal !== 'all') {
        filtered = filtered.filter(function(r) { 
            return r.expert_specialty === categoryVal; 
        });
    }
    
    console.log('📊 Filtered data:', filtered.length);
    
    // Pagination
    var totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
    if (currentPage > totalPages) currentPage = 1;
    var items = filtered.slice((currentPage - 1) * PER_PAGE, currentPage * PER_PAGE);
    
    // Tentukan container berdasarkan tab
    var containerId = currentTab === 'pending' ? 'pendingContainer' : 'reviewsContainer';
    var container = document.getElementById(containerId);
    
    if (!container) {
        console.error('❌ Container not found:', containerId);
        return;
    }
    
    console.log('📦 Rendering to:', containerId);
    console.log('📦 Items to render:', items.length);
    
    if (items.length === 0) {
        container.innerHTML = '<div class="empty-state" style="text-align:center;padding:48px;color:#9aaa9e;">No consultations found.</div>';
    } else {
        container.innerHTML = items.map(function(r) {
            var actionHtml = '';
            if (r.can_review) {
                actionHtml = '<button class="rate-btn" onclick="openRatingModal(' + r.id + ')">⭐ Rate Now</button>';
            } else if (r.has_reviewed) {
                actionHtml = '<div class="reviewed-badge">⭐ ' + r.rating_value + '/5 - Reviewed</div>';
            }
            
            return '<div class="review-card">' +
                '<div class="review-card-header">' +
                    '<div class="review-expert-info">' +
                        '<div class="review-expert-name">' + (r.expert_name || 'Unknown Expert') + '</div>' +
                        '<div class="review-expert-specialty">' + (r.expert_specialty || 'Expert') + '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="review-card-body">' +
                    '<div class="review-topic">' + (r.consultation_topic || 'General Consultation') + '</div>' +
                    '<div class="review-date">Consulted on ' + (r.consultation_date || '-') + '</div>' +
                '</div>' +
                '<div class="review-card-footer">' +
                    actionHtml +
                '</div>' +
            '</div>';
        }).join("");
    }
    
    // Tampilkan/hide panel
    var panelPending = document.getElementById('panelPending');
    var panelCompleted = document.getElementById('panelCompleted');
    
    if (panelPending) panelPending.style.display = currentTab === 'pending' ? 'block' : 'none';
    if (panelCompleted) panelCompleted.style.display = currentTab === 'completed' ? 'block' : 'none';
    
    // Update load more button
    var loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        if (items.length < filtered.length) {
            loadMoreBtn.style.display = 'block';
        } else {
            loadMoreBtn.style.display = 'none';
        }
    }
    
    console.log('✅ Render complete!');
}

// ──────────────────────────────────────────────────────────────
// TABS
// ──────────────────────────────────────────────────────────────
function switchTab(tab) {
    console.log('🔄 Switching to tab:', tab);
    currentTab = tab;
    currentPage = 1;
    
    // Update tab buttons
    var tabPending = document.getElementById('tabPending');
    var tabCompleted = document.getElementById('tabCompleted');
    
    if (tabPending) tabPending.classList.toggle('active', tab === 'pending');
    if (tabCompleted) tabCompleted.classList.toggle('active', tab === 'completed');
    
    renderReviews();
}

// ──────────────────────────────────────────────────────────────
// OPEN RATING MODAL
// ──────────────────────────────────────────────────────────────
function openRatingModal(konsultasiId) {
    console.log('🔄 Opening rating modal for:', konsultasiId);
    
    var konsultasi = allReviews.find(function(r) { return r.id === konsultasiId; });
    if (!konsultasi) {
        console.error('❌ Consultation not found:', konsultasiId);
        return;
    }
    
    // Isi data ke modal
    document.getElementById('rateConsultDate').textContent = 'Consulted on ' + (konsultasi.consultation_date || '-');
    document.getElementById('modalKonsultasiId').value = konsultasiId;
    
    // Reset form
    resetStars();
    document.getElementById('rateComment').value = '';
    
    // Tampilkan modal
    var modal = document.getElementById('rateModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('show');
        modal.style.display = 'flex';
    }
}

function closeRatingModal() {
    var modal = document.getElementById('rateModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('show');
        modal.style.display = 'none';
    }
}

// ──────────────────────────────────────────────────────────────
// STAR RATING
// ──────────────────────────────────────────────────────────────
var selectedRating = 0;

function resetStars() {
    selectedRating = 0;
    var stars = document.querySelectorAll('.star-pick');
    stars.forEach(function(star) {
        star.classList.remove('active');
    });
}

function setRating(value) {
    selectedRating = value;
    var stars = document.querySelectorAll('.star-pick');
    stars.forEach(function(star) {
        var starValue = parseInt(star.getAttribute('data-val'));
        if (starValue <= value) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}

// ──────────────────────────────────────────────────────────────
// SUBMIT REVIEW
// ──────────────────────────────────────────────────────────────
function submitReview() {
    if (selectedRating === 0) {
        alert('Please select a rating first! ⭐');
        return;
    }
    
    var konsultasiId = document.getElementById('modalKonsultasiId').value;
    var ulasan = document.getElementById('rateComment').value.trim();
    
    console.log('📤 Submitting review:', {
        konsultasi_id: konsultasiId,
        nilai: selectedRating,
        ulasan: ulasan
    });
    
    var formData = new FormData();
    formData.append('konsultasi_id', konsultasiId);
    formData.append('nilai', selectedRating);
    formData.append('ulasan', ulasan);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    
    var submitBtn = document.getElementById('rateNowBtn');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
    }
    
    fetch('/reviews', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(function(res) {
        return res.json();
    })
    .then(function(data) {
        console.log('📥 Response:', data);
        
        if (data.message) {
            alert('✅ ' + data.message);
            closeRatingModal();
            // Refresh data
            fetchReviews();
        } else {
            alert('❌ ' + (data.error || 'Failed to submit review'));
        }
    })
    .catch(function(err) {
        console.error('❌ Error:', err);
        alert('❌ Failed to submit review. Please try again.');
    })
    .finally(function() {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Rate Now';
        }
    });
}
// ──────────────────────────────────────────────────────────────
// LOAD MORE
// ──────────────────────────────────────────────────────────────
function loadMore() {
    currentPage++;
    renderReviews();
}

// ──────────────────────────────────────────────────────────────
// SIDEBAR TOGGLE
// ──────────────────────────────────────────────────────────────
function toggleSidebar() {
    var sidebar = document.getElementById('sidebar');
    var mainContent = document.getElementById('mainContent');
    
    if (sidebar) {
        sidebar.classList.toggle('closed');
        sidebar.classList.toggle('show');
    }
    if (mainContent) {
        mainContent.classList.toggle('full');
        mainContent.classList.toggle('shifted');
    }
}

// ──────────────────────────────────────────────────────────────
// EVENT LISTENERS
// ──────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOM loaded! Starting reviews page...');
    
    // Fetch data
    fetchReviews();
    
    // Tab buttons
    var tabPending = document.getElementById('tabPending');
    var tabCompleted = document.getElementById('tabCompleted');
    
    if (tabPending) {
        tabPending.addEventListener('click', function() { switchTab('pending'); });
    }
    if (tabCompleted) {
        tabCompleted.addEventListener('click', function() { switchTab('completed'); });
    }
    
    // Sidebar toggle
    var menuToggle = document.getElementById('menuToggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', toggleSidebar);
    }
    
    // Close modal
    var modalClose = document.getElementById('modalClose');
    if (modalClose) {
        modalClose.addEventListener('click', closeRatingModal);
    }
    
    var modal = document.getElementById('ratingModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) closeRatingModal();
        });
    }
    
    // Star buttons
    document.querySelectorAll('.star-pick').forEach(function(star) {
        star.addEventListener('click', function() {
            setRating(parseInt(this.getAttribute('data-val')));
        });
    });
    
    // Search input
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentPage = 1;
            renderReviews();
        });
    }
    
    // Rating filter
    var ratingFilter = document.getElementById('ratingFilter');
    if (ratingFilter) {
        ratingFilter.addEventListener('change', function() {
            currentPage = 1;
            renderReviews();
        });
    }
    
    // Category filter
    var categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            currentPage = 1;
            renderReviews();
        });
    }
    
    // Load more button
    var loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', loadMore);
    }
    
    // Rate now button di modal
    var rateNowBtn = document.getElementById('rateNowBtn');
    if (rateNowBtn) {
        rateNowBtn.addEventListener('click', submitReview);
    }
    
    // Rate later button
    var rateLaterBtn = document.getElementById('rateLaterBtn');
    if (rateLaterBtn) {
        rateLaterBtn.addEventListener('click', closeRatingModal);
    }
    
    // Keyboard escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeRatingModal();
    });
    
    console.log('✅ All event listeners attached!');
});