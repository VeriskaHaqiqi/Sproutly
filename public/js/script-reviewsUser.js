document.addEventListener('DOMContentLoaded', () => {
    // --- Data Management ---
    let reviewsData = [
        {
            id: 1,
            expertName: "Dr. Marcus Thompson",
            avatar: "https://i.pravatar.cc/150?u=marcus",
            specialty: "Crop Specialist",
            consultation: "Tomato Disease Management",
            rating: 5,
            comment: "Dr. Thompson provided excellent guidance on identifying and treating early blight in my tomato crops. His recommendations were practical and effective. The follow-up advice was particularly helpful.",
            date: "March 15, 2026"
        },
        {
            id: 2,
            expertName: "Sarah Chen",
            avatar: "https://i.pravatar.cc/150?u=sarah",
            specialty: "Irrigation Expert",
            consultation: "Drip Irrigation Setup",
            rating: 4,
            comment: "Sarah helped me design an efficient drip irrigation system for my greenhouse. The water usage has decreased significantly while maintaining optimal plant health. Very knowledgeable and responsive.",
            date: "March 8, 2026"
        },
        {
            id: 3,
            expertName: "James Rodriguez",
            avatar: "https://i.pravatar.cc/150?u=james",
            specialty: "Soil Scientist",
            consultation: "Soil pH Balance",
            rating: 5,
            comment: "James conducted a thorough soil analysis and provided detailed recommendations for improving pH levels. The step-by-step plan was easy to follow and the results have been excellent.",
            date: "February 28, 2026"
        },
        {
            id: 4,
            expertName: "Dr. Emily Foster",
            avatar: "https://i.pravatar.cc/150?u=emily",
            specialty: "Pest Control",
            consultation: "Organic Pest Management",
            rating: 4,
            comment: "Dr. Foster introduced me to several organic pest control methods that have been very effective. Her knowledge of beneficial insects and natural deterrents is impressive.",
            date: "February 20, 2026"
        },
        {
            id: 5,
            expertName: "Michael Zhang",
            avatar: "https://i.pravatar.cc/150?u=michael",
            specialty: "Hydroponics",
            consultation: "Nutrient Solution Optimization",
            rating: 5,
            comment: "Setting up a hydroponic tower seemed daunting until I spoke with Michael. He made the science of nutrient mixing very easy to understand.",
            date: "February 12, 2026"
        },
        {
            id: 6,
            expertName: "Elena Rossi",
            avatar: "https://i.pravatar.cc/150?u=elena",
            specialty: "Plant Disease",
            consultation: "Rose Fungal Infection",
            rating: 3,
            comment: "The advice was solid, although I wish the response time was a bit faster. My roses are recovering slowly.",
            date: "February 05, 2026"
        }
    ];

    let itemsToShow = 4;

    // --- Selectors ---
    const sidebar = document.getElementById('sidebarUser');
    const overlay = document.getElementById('sidebarOverlay');
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const searchInput = document.getElementById('searchInput');
    const ratingFilter = document.getElementById('ratingFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const container = document.getElementById('reviewsContainer');

    // --- Sidebar Functions ---
    const toggleSidebar = () => {
        sidebar.classList.toggle('active');
        overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
    };

    hamburgerBtn.addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    // --- Core Logic ---

    const createStars = (rating) => {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            const color = i <= rating ? '#fdcb6e' : '#dfe6e9';
            stars += `<svg class="star" fill="${color}" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>`;
        }
        return stars;
    };

    const renderReviews = () => {
        const query = searchInput.value.toLowerCase();
        const ratingVal = ratingFilter.value;
        const catVal = categoryFilter.value;

        // Filtering Logic
        let filtered = reviewsData.filter(item => {
            const matchesSearch = item.expertName.toLowerCase().includes(query) || 
                                 item.consultation.toLowerCase().includes(query) || 
                                 item.comment.toLowerCase().includes(query);
            
            const matchesRating = ratingVal === 'all' || item.rating == ratingVal;
            const matchesCategory = catVal === 'all' || item.specialty === catVal;

            return matchesSearch && matchesRating && matchesCategory;
        });

        // Pagination
        const displayList = filtered.slice(0, itemsToShow);
        
        container.innerHTML = '';

        if (displayList.length === 0) {
            container.innerHTML = `<div style="text-align:center; padding: 40px; color:#94a3b8;">No reviews matching your criteria found.</div>`;
            loadMoreBtn.style.display = 'none';
            return;
        }

        displayList.forEach(review => {
            const card = document.createElement('div');
            card.className = 'review-card';
            card.innerHTML = `
                <div class="expert-meta">
                    <div class="exp-profile">
                        <img src="${review.avatar}" class="exp-avatar" alt="${review.expertName}">
                        <div class="exp-name-box">
                            <h3>${review.expertName}</h3>
                            <span class="specialty-tag">${review.specialty}</span>
                        </div>
                    </div>
                    <p class="consult-title">Consultation: ${review.consultation}</p>
                    <div class="stars-row">
                        <div class="star-group">${createStars(review.rating)}</div>
                        <span class="rating-score">${review.rating}.0</span>
                    </div>
                </div>
                <div class="review-content">
                    <p class="review-para">"${review.comment}"</p>
                    <div class="review-action">
                        <span class="date-text">${review.date}</span>
                        <button class="delete-btn" onclick="handleDelete(${review.id})">Delete Review</button>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });

        // Toggle Load More
        loadMoreBtn.style.display = (filtered.length > itemsToShow) ? 'inline-block' : 'none';
    };

    // --- Action Handlers ---

    window.handleDelete = (id) => {
        if (confirm('Are you sure you want to delete this review?')) {
            reviewsData = reviewsData.filter(r => r.id !== id);
            renderReviews();
        }
    };

    loadMoreBtn.addEventListener('click', () => {
        itemsToShow = reviewsData.length; // Show all
        renderReviews();
    });

    [searchInput, ratingFilter, categoryFilter].forEach(el => {
        el.addEventListener('change', () => { itemsToShow = 4; renderReviews(); });
        el.addEventListener('input', () => { itemsToShow = 4; renderReviews(); });
    });

    // Initial Render
    renderReviews();
});