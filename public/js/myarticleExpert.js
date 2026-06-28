document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const deleteModeBtn = document.getElementById("deleteModeBtn");
    const selectionBar = document.getElementById("selectionBar");
    const selectionText = document.getElementById("selectionText");
    const cancelSelectionBtn = document.getElementById("cancelSelectionBtn");
    const deleteSelectedBtn = document.getElementById("deleteSelectedBtn");

    const articlesGrid = document.getElementById("articlesGrid");
    const articleCards = document.querySelectorAll(".article-card");
    const selectCircles = document.querySelectorAll(".select-circle");

    const confirmDeleteModal = document.getElementById("confirmDeleteModal");
    const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
    const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

    const deletedModal = document.getElementById("deletedModal");
    const closeDeletedModalBtn = document.getElementById("closeDeletedModalBtn");

    let deleteMode = false;

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

    function updateSelectionCount() {
        const selectedCards = document.querySelectorAll(".article-card.selected").length;

        if (selectedCards === 0) {
            selectionText.textContent = "Select article(s) you want to delete";
        } else {
            selectionText.textContent = `${selectedCards} article selected`;
        }
    }

    function enableDeleteMode() {
        deleteMode = true;
        articlesGrid.classList.add("delete-mode");
        selectionBar.classList.add("show");

        articleCards.forEach((card) => {
            card.classList.add("selectable");
        });

        updateSelectionCount();
    }

    function disableDeleteMode() {
        deleteMode = false;
        articlesGrid.classList.remove("delete-mode");
        selectionBar.classList.remove("show");

        articleCards.forEach((card) => {
            card.classList.remove("selectable");
            card.classList.remove("selected");
        });

        updateSelectionCount();
    }

    if (deleteModeBtn) {
        deleteModeBtn.addEventListener("click", function () {
            if (deleteMode) {
                disableDeleteMode();
            } else {
                enableDeleteMode();
            }
        });
    }

    articleCards.forEach((card) => {
        card.addEventListener("click", function (e) {
            if (!deleteMode) return;

            const clickedEditLink = e.target.closest(".article-footer a");
            if (clickedEditLink) return;

            card.classList.toggle("selected");
            updateSelectionCount();
        });
    });

    selectCircles.forEach((circle) => {
        circle.addEventListener("click", function (e) {
            e.stopPropagation();
            const card = this.closest(".article-card");

            if (!deleteMode || !card) return;

            card.classList.toggle("selected");
            updateSelectionCount();
        });
    });

    if (cancelSelectionBtn) {
        cancelSelectionBtn.addEventListener("click", function () {
            disableDeleteMode();
        });
    }

    if (deleteSelectedBtn) {
        deleteSelectedBtn.addEventListener("click", function () {
            const selectedCards = document.querySelectorAll(".article-card.selected");

            if (selectedCards.length === 0) {
                alert("Please select at least one article to delete.");
                return;
            }

            confirmDeleteModal.classList.add("show");
        });
    }

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener("click", function () {
            confirmDeleteModal.classList.remove("show");
        });
    }

    if (confirmDeleteBtn) {
    confirmDeleteBtn.addEventListener("click", function () {
        const selectedCards = document.querySelectorAll(".article-card.selected");
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        let deletedCount = 0;
        let totalSelected = selectedCards.length;

        selectedCards.forEach((card) => {
            const articleId = card.getAttribute("data-id");
            
            if (articleId && !isNaN(articleId)) {
                fetch(`/tulisartikelExpert/${articleId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        deletedCount++;
                        card.remove();
                        
                        // Jika semua sudah terhapus
                        if (deletedCount === totalSelected) {
                            confirmDeleteModal.classList.remove("show");
                            deletedModal.classList.add("show");
                            disableDeleteMode();
                            
                            // Cek apakah masih ada artikel
                            const remainingCards = document.querySelectorAll(".article-card");
                            if (remainingCards.length === 0) {
                                const grid = document.getElementById("articlesGrid");
                                grid.innerHTML = `
                                    <div class="empty-state" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                                        <h3>No articles yet</h3>
                                        <p>Start creating your first article by clicking the "New Article" button.</p>
                                        <a href="/tulisartikelExpert" class="btn-primary" style="display: inline-block; margin-top: 16px; padding: 12px 24px; background: #76ead0; color: #1a2636; border-radius: 8px; text-decoration: none; font-weight: 600;">
                                            + New Article
                                        </a>
                                    </div>
                                `;
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error deleting article:', error);
                });
            } else {
                // Untuk data dummy (ID 1-4), hapus langsung dari DOM
                card.remove();
                deletedCount++;
                
                if (deletedCount === totalSelected) {
                    confirmDeleteModal.classList.remove("show");
                    deletedModal.classList.add("show");
                    disableDeleteMode();
                }
            }
        });
    });
    }

    if (closeDeletedModalBtn) {
        closeDeletedModalBtn.addEventListener("click", function () {
            deletedModal.classList.remove("show");
        });
    }

    if (confirmDeleteModal) {
        confirmDeleteModal.addEventListener("click", function (e) {
            if (e.target === confirmDeleteModal) {
                confirmDeleteModal.classList.remove("show");
            }
        });
    }

    if (deletedModal) {
        deletedModal.addEventListener("click", function (e) {
            if (e.target === deletedModal) {
                deletedModal.classList.remove("show");
            }
        });
    }
});