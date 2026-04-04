document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const mainContent = document.getElementById("mainContent");
    const sidebarOverlay = document.getElementById("sidebarOverlay");

    const featureImage = document.getElementById("featureImage");
    const imagePreview = document.getElementById("imagePreview");
    const uploadPlaceholder = document.getElementById("uploadPlaceholder");

    const addTagBtn = document.getElementById("addTagBtn");
    const tagList = document.getElementById("tagList");

    const publishBtn = document.getElementById("publishBtn");
    const publishModal = document.getElementById("publishModal");
    const closeModalBtn = document.getElementById("closeModalBtn");

    const articleEditor = document.getElementById("articleEditor");
    const toolbarButtons = document.querySelectorAll(".toolbar-btn[data-command]");
    const headingButtons = document.querySelectorAll(".heading-btn");
    const quoteBtn = document.getElementById("quoteBtn");
    const linkBtn = document.getElementById("linkBtn");

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

    if (featureImage) {
        featureImage.addEventListener("change", function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                    uploadPlaceholder.style.display = "none";
                };

                reader.readAsDataURL(file);
            }
        });
    }

    if (addTagBtn) {
        addTagBtn.addEventListener("click", function () {
            const tagName = prompt("Enter tag name:");

            if (tagName && tagName.trim() !== "") {
                const newTag = document.createElement("span");
                newTag.className = "tag-chip";
                newTag.innerHTML = `${tagName.trim()} <button type="button" class="remove-tag">×</button>`;
                tagList.appendChild(newTag);
            }
        });
    }

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-tag")) {
            e.target.parentElement.remove();
        }
    });

    toolbarButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const command = this.dataset.command;
            document.execCommand(command, false, null);
            articleEditor.focus();
        });
    });

    headingButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const heading = this.dataset.heading.toUpperCase();
            document.execCommand("formatBlock", false, heading);
            articleEditor.focus();
        });
    });

    if (quoteBtn) {
        quoteBtn.addEventListener("click", function () {
            document.execCommand("formatBlock", false, "BLOCKQUOTE");
            articleEditor.focus();
        });
    }

    if (linkBtn) {
        linkBtn.addEventListener("click", function () {
            const url = prompt("Enter URL:");

            if (url) {
                document.execCommand("createLink", false, url);
                articleEditor.focus();
            }
        });
    }

    if (publishBtn) {
        publishBtn.addEventListener("click", function () {
            publishModal.classList.add("show");
        });
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", function () {
            publishModal.classList.remove("show");
        });
    }

    if (publishModal) {
        publishModal.addEventListener("click", function (e) {
            if (e.target === publishModal) {
                publishModal.classList.remove("show");
            }
        });
    }
});