document.addEventListener("DOMContentLoaded", function() {
    
    const topicWrap    = document.getElementById("topicWrap");
    const articleCards = document.querySelectorAll(".article-card");
    const articleSearch = document.getElementById("articleSearch");
    const searchButton  = document.getElementById("searchButton");
    const emptyState    = document.getElementById("emptyState");
    const bookmarkBtns  = document.querySelectorAll(".bookmark-btn");

    let activeTopic = "all";

    // ── Toast Notification ────────────────────────────
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 12px 24px;
            background: ${type === 'success' ? '#10b981' : '#ef4444'};
            color: white;
            border-radius: 8px;
            font-size: 14px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-family: 'Inter', sans-serif;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // ── Filter ────────────────────────────────────────
    function filterArticles() {
        const keyword = (articleSearch?.value || "").trim().toLowerCase();
        let visible = 0;

        articleCards.forEach((card) => {
            const matchesTopic = activeTopic === "all" || card.dataset.topic === activeTopic;
            const matchesSearch = !keyword ||
                card.dataset.title.toLowerCase().includes(keyword) ||
                card.dataset.topic.toLowerCase().includes(keyword) ||
                card.dataset.keywords.toLowerCase().includes(keyword) ||
                card.dataset.author.toLowerCase().includes(keyword);

            const show = matchesTopic && matchesSearch;
            card.style.display = show ? "block" : "none";
            if (show) visible++;
        });

        emptyState.classList.toggle("hidden", visible > 0);
    }

    topicWrap?.addEventListener("click", (e) => {
        const chip = e.target.closest(".topic-chip");
        if (!chip) return;
        document.querySelectorAll(".topic-chip").forEach(c => c.classList.remove("active"));
        chip.classList.add("active");
        activeTopic = chip.dataset.topic;
        filterArticles();
    });

    articleSearch?.addEventListener("input", filterArticles);
    searchButton?.addEventListener("click", filterArticles);

    // ── BOOKMARK ──────────────────────────────────────
    bookmarkBtns.forEach((btn) => {
        const card = btn.closest('.article-card');
        if (!card) return;
        const key = card.dataset.key;

        btn.addEventListener("click", async (e) => {
            e.preventDefault();
            e.stopPropagation();

            console.log('📌 Bookmark clicked for article:', key);

            const isCurrentlyBookmarked = btn.classList.contains("bookmarked");
            const url = `/artikel/${key}/bookmark`;
            const method = isCurrentlyBookmarked ? "DELETE" : "POST";
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            console.log('📤 URL:', url);
            console.log('📤 Method:', method);
            console.log('🔑 CSRF:', csrfToken);

            // Disable button
            btn.disabled = true;
            btn.style.opacity = '0.6';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    }
                });

                console.log('📥 Response status:', response.status);
                const data = await response.json();
                console.log('📥 Response data:', data);

                if (response.ok && data.success !== false) {
                    btn.classList.toggle("bookmarked");
                    if (!isCurrentlyBookmarked) {
                        showToast('✅ Artikel berhasil di-bookmark', 'success');
                    } else {
                        showToast('🗑️ Bookmark dihapus', 'success');
                    }
                } else {
                    showToast('❌ ' + (data.message || 'Gagal toggle bookmark'), 'error');
                }
            } catch (err) {
                console.error('❌ Error:', err);
                showToast('❌ Gagal toggle bookmark. Cek console.', 'error');
            } finally {
                btn.disabled = false;
                btn.style.opacity = '1';
            }
        });
    });

    // ── Init ──────────────────────────────────────────
    filterArticles();

    // ── Sidebar toggle ────────────────────────────────
    (function () {
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");
        const toggle = document.getElementById("menuToggle");
        if (!sidebar || !mainContent || !toggle) return;

        function open() {
            if (window.innerWidth <= 768) {
                sidebar.classList.add("show");
                sidebar.classList.remove("closed");
            } else {
                sidebar.classList.remove("closed");
                mainContent.classList.add("shifted");
                mainContent.classList.remove("full");
            }
        }

        function close() {
            sidebar.classList.add("closed");
            sidebar.classList.remove("show");
            mainContent.classList.remove("shifted");
            mainContent.classList.add("full");
        }

        function isOpen() {
            return window.innerWidth <= 768 ? sidebar.classList.contains("show") : !sidebar.classList.contains("closed");
        }

        toggle.addEventListener("click", () => isOpen() ? close() : open());
        document.querySelectorAll(".menu-link").forEach(l => l.addEventListener("click", close));
        document.addEventListener("click", (e) => {
            if (window.innerWidth <= 768 && isOpen() && !sidebar.contains(e.target) && !toggle.contains(e.target)) close();
        });
        window.addEventListener("resize", () => {
            if (window.innerWidth > 768) sidebar.classList.remove("show");
            else {
                mainContent.classList.remove("shifted");
                mainContent.classList.add("full");
            }
        });
    })();

    // ── Tambahkan CSS untuk animasi toast ─────────────
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);

    console.log('✅ Bookmark script loaded!');
});