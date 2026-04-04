document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const searchInput = document.getElementById("searchInput");
    const ratingFilter = document.getElementById("ratingFilter");
    const timeFilter = document.getElementById("timeFilter");
    const sortFilter = document.getElementById("sortFilter");

    const reviewsList = document.getElementById("reviewsList");
    const pagination = document.getElementById("pagination");
    const averageRatingEl = document.getElementById("averageRating");
    const totalReviewsEl = document.getElementById("totalReviews");

    const reviews = [
        {
            id: 1,
            name: "Sarah Jenkins",
            avatar: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=300&auto=format&fit=crop",
            status: "Excellent",
            rating: 5,
            date: "2023-10-24",
            consultationDate: "Oct 24, 2023",
            text: "\"Dr. Reed was incredibly helpful with my dying Fiddle Leaf Fig! His advice on drainage and light positioning completely revived it within two weeks....\""
        },
        {
            id: 2,
            name: "Michael Chen",
            avatar: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&auto=format&fit=crop",
            status: "Excellent",
            rating: 5,
            date: "2023-10-20",
            consultationDate: "Oct 20, 2023",
            text: "\"Excellent depth of knowledge on soil nutrients. My office succulents have never looked greener. The digital greenhouse report provided after the call...\""
        },
        {
            id: 3,
            name: "Elena Rodriguez",
            avatar: "https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=300&auto=format&fit=crop",
            status: "Good",
            rating: 4,
            date: "2023-10-15",
            consultationDate: "Oct 15, 2023",
            text: "\"Great session, very informative. Only giving 4 stars because the call started 5 minutes late, but the actual expertise was top-notch.\""
        },
        {
            id: 4,
            name: "Daniel Foster",
            avatar: "https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?q=80&w=300&auto=format&fit=crop",
            status: "Excellent",
            rating: 5,
            date: "2023-10-10",
            consultationDate: "Oct 10, 2023",
            text: "\"Super practical advice for hydroponic basil. I applied the nutrient schedule and saw visible improvement in less than a week.\""
        },
        {
            id: 5,
            name: "Ava Mitchell",
            avatar: "https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=300&auto=format&fit=crop",
            status: "Good",
            rating: 4,
            date: "2023-10-06",
            consultationDate: "Oct 6, 2023",
            text: "\"Very kind and knowledgeable. I especially appreciated the pest prevention checklist shared after the session.\""
        },
        {
            id: 6,
            name: "Ryan Park",
            avatar: "https://images.unsplash.com/photo-1504593811423-6dd665756598?q=80&w=300&auto=format&fit=crop",
            status: "Good",
            rating: 4,
            date: "2023-10-01",
            consultationDate: "Oct 1, 2023",
            text: "\"Useful suggestions for improving lettuce growth indoors. Would love even more detail on lighting brands next time.\""
        },
        {
            id: 7,
            name: "Sophia Green",
            avatar: "https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?q=80&w=300&auto=format&fit=crop",
            status: "Excellent",
            rating: 5,
            date: "2023-09-28",
            consultationDate: "Sep 28, 2023",
            text: "\"My tomato plants bounced back after following the pruning and nutrient recommendations. Amazing consultation!\""
        },
        {
            id: 8,
            name: "Lucas Brown",
            avatar: "https://images.unsplash.com/photo-1504257432389-52343af06ae3?q=80&w=300&auto=format&fit=crop",
            status: "Good",
            rating: 3,
            date: "2023-09-22",
            consultationDate: "Sep 22, 2023",
            text: "\"The session was decent and informative, but I needed a bit more actionable detail for my specific setup.\""
        },
        {
            id: 9,
            name: "Nina Carter",
            avatar: "https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=300&auto=format&fit=crop",
            status: "Excellent",
            rating: 5,
            date: "2023-09-18",
            consultationDate: "Sep 18, 2023",
            text: "\"Fantastic explanation of root rot causes and prevention. Easy to understand and very actionable.\""
        }
    ];

    let currentPage = 1;
    const itemsPerPage = 3;

    function closeSidebarDesktop() {
        sidebar.classList.add("hidden");
        mainContent.classList.add("full");
    }

    function openSidebarDesktop() {
        sidebar.classList.remove("hidden");
        mainContent.classList.remove("full");
    }

    function closeSidebarMobile() {
        sidebar.classList.remove("show");
        sidebarOverlay.classList.remove("show");
    }

    function openSidebarMobile() {
        sidebar.classList.add("show");
        sidebarOverlay.classList.add("show");
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", function () {
            if (window.innerWidth <= 768) {
                if (sidebar.classList.contains("show")) {
                    closeSidebarMobile();
                } else {
                    openSidebarMobile();
                }
            } else {
                if (sidebar.classList.contains("hidden")) {
                    openSidebarDesktop();
                } else {
                    closeSidebarDesktop();
                }
            }
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener("click", function () {
            closeSidebarMobile();
        });
    }

    function getStars(rating) {
        let stars = "";
        for (let i = 1; i <= 5; i++) {
            stars += i <= rating ? "★" : "☆";
        }
        return stars;
    }

    function getStatusClass(status) {
        return status.toLowerCase() === "excellent" ? "excellent" : "good";
    }

    function updateStats(filteredReviews) {
        if (filteredReviews.length === 0) {
            averageRatingEl.textContent = "0.0";
            totalReviewsEl.textContent = "0";
            return;
        }

        const total = filteredReviews.reduce((sum, item) => sum + item.rating, 0);
        const avg = (total / filteredReviews.length).toFixed(1);

        averageRatingEl.textContent = avg;
        totalReviewsEl.textContent = filteredReviews.length;
    }

    function filterAndSortReviews() {
        const searchValue = searchInput.value.toLowerCase().trim();
        const ratingValue = ratingFilter.value;
        const timeValue = timeFilter.value;
        const sortValue = sortFilter.value;

        let filtered = [...reviews];

        if (searchValue) {
            filtered = filtered.filter((review) =>
                review.name.toLowerCase().includes(searchValue) ||
                review.text.toLowerCase().includes(searchValue)
            );
        }

        if (ratingValue !== "all") {
            filtered = filtered.filter((review) => review.rating === Number(ratingValue));
        }

        if (timeValue === "latest") {
            filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
        } else if (timeValue === "oldest") {
            filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
        }

        if (sortValue === "newest") {
            filtered.sort((a, b) => new Date(b.date) - new Date(a.date));
        } else if (sortValue === "oldest") {
            filtered.sort((a, b) => new Date(a.date) - new Date(b.date));
        } else if (sortValue === "highest") {
            filtered.sort((a, b) => b.rating - a.rating || new Date(b.date) - new Date(a.date));
        } else if (sortValue === "lowest") {
            filtered.sort((a, b) => a.rating - b.rating || new Date(b.date) - new Date(a.date));
        }

        return filtered;
    }

    function renderReviews() {
        const filteredReviews = filterAndSortReviews();
        updateStats(filteredReviews);

        const totalPages = Math.max(1, Math.ceil(filteredReviews.length / itemsPerPage));
        if (currentPage > totalPages) currentPage = totalPages;

        const start = (currentPage - 1) * itemsPerPage;
        const currentItems = filteredReviews.slice(start, start + itemsPerPage);

        if (currentItems.length === 0) {
            reviewsList.innerHTML = `
                <div class="review-card">
                    <div class="review-content">
                        <h3>No review found</h3>
                        <p class="review-text">Try changing the search or filter options.</p>
                    </div>
                </div>
            `;
        } else {
            reviewsList.innerHTML = currentItems.map((review) => `
                <article class="review-card">
                    <div class="review-left">
                        <img src="${review.avatar}" alt="${review.name}" class="review-avatar">

                        <div class="review-content">
                            <div class="review-topline">
                                <h3>${review.name}</h3>
                                <span class="badge ${getStatusClass(review.status)}">${review.status}</span>
                            </div>

                            <p class="review-date">Consultation Date: ${review.consultationDate}</p>
                            <div class="stars">${getStars(review.rating)}</div>
                            <p class="review-text">${review.text}</p>
                        </div>
                    </div>

                    <div class="review-action">
                        <button type="button" class="detail-btn">View Detail</button>
                    </div>
                </article>
            `).join("");
        }

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        let html = `
            <button class="page-btn" data-page="prev">‹</button>
        `;

        for (let i = 1; i <= totalPages; i++) {
            html += `
                <button class="page-btn number ${i === currentPage ? "active" : ""}" data-page="${i}">
                    ${i}
                </button>
            `;
        }

        html += `
            <button class="page-btn" data-page="next">›</button>
        `;

        pagination.innerHTML = html;
    }

    pagination.addEventListener("click", function (e) {
        const button = e.target.closest(".page-btn");
        if (!button) return;

        const filteredReviews = filterAndSortReviews();
        const totalPages = Math.max(1, Math.ceil(filteredReviews.length / itemsPerPage));
        const action = button.dataset.page;

        if (action === "prev" && currentPage > 1) {
            currentPage--;
        } else if (action === "next" && currentPage < totalPages) {
            currentPage++;
        } else if (!isNaN(action)) {
            currentPage = Number(action);
        }

        renderReviews();
    });

    [searchInput, ratingFilter, timeFilter, sortFilter].forEach((element) => {
        element.addEventListener("input", function () {
            currentPage = 1;
            renderReviews();
        });

        element.addEventListener("change", function () {
            currentPage = 1;
            renderReviews();
        });
    });

    renderReviews();
});