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

    function getArticleContent() {
        // Create a temporary element to manipulate HTML formatting to markdown headers/quotes
        const temp = document.createElement('div');
        temp.innerHTML = articleEditor.innerHTML;
        
        const headings1 = temp.querySelectorAll('h1');
        headings1.forEach(h => {
            h.outerHTML = `\n# ${h.textContent}\n`;
        });
        const headings2 = temp.querySelectorAll('h2');
        headings2.forEach(h => {
            h.outerHTML = `\n## ${h.textContent}\n`;
        });
        const quotes = temp.querySelectorAll('blockquote');
        quotes.forEach(q => {
            q.outerHTML = `\n> ${q.textContent}\n`;
        });
        
        return temp.textContent.trim().replace(/\n{3,}/g, '\n\n');
    }

    if (publishBtn) {
        publishBtn.addEventListener("click", function () {
            const title = document.getElementById("articleTitle")?.value.trim();
            const content = getArticleContent();
            const tagChips = document.querySelectorAll("#tagList .tag-chip");
            let tags = Array.from(tagChips).map(chip => {
                let text = chip.textContent || chip.innerText || "";
                return text.replace("×", "").trim();
            });
            const category = tags.length > 0 ? tags[0] : "General";
            const fileInput = document.getElementById("featureImage");
            
            if (!title) {
                alert("Please enter an article title.");
                return;
            }
            if (!content) {
                alert("Please write some content for your article.");
                return;
            }
            
            const formData = new FormData();
            formData.append("judul", title);
            formData.append("konten", content);
            formData.append("kategori", category);
            if (fileInput && fileInput.files.length > 0) {
                formData.append("thumbnail", fileInput.files[0]);
            }
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            publishBtn.disabled = true;
            publishBtn.textContent = "Publishing...";
            
            fetch("/tulisartikelExpert/store", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Failed to publish article");
                }
                return response.json();
            })
            .then(data => {
                publishModal.classList.add("show");
            })
            .catch(error => {
                console.error(error);
                alert("Error publishing article. Please try again.");
            })
            .finally(() => {
                publishBtn.disabled = false;
                publishBtn.textContent = "Publish >";
            });
        });
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener("click", function () {
            publishModal.classList.remove("show");
            window.location.href = "/myarticleExpert";
        });
    }

    if (publishModal) {
        publishModal.addEventListener("click", function (e) {
            if (e.target === publishModal) {
                publishModal.classList.remove("show");
                window.location.href = "/myarticleExpert";
            }
        });
    }
});