/**
 * Sidebar JavaScript - Sparepart Jawi
 * Handles mobile sidebar toggle, animations, and interactions
 */

const Sidebar = (function () {
    // Private variables
    let sidebar = null;
    let overlay = null;
    let menuToggle = null;
    let closeButton = null;

    /**
     * Initialize sidebar elements and event listeners
     */
    function init() {
        // Get DOM elements
        sidebar = document.getElementById("sidebar");
        overlay = document.getElementById("sidebar-overlay");
        menuToggle = document.getElementById("menu-toggle");
        closeButton = document.getElementById("sidebar-close");

        if (!sidebar) return;

        // Set initial state
        if (window.innerWidth < 1024) {
            sidebar.classList.add("-translate-x-full");
        }

        // Add event listeners
        if (menuToggle) {
            menuToggle.addEventListener("click", openSidebar);
        }

        if (closeButton) {
            closeButton.addEventListener("click", closeSidebar);
        }

        if (overlay) {
            overlay.addEventListener("click", closeSidebar);
        }

        // Handle escape key
        document.addEventListener("keydown", handleEscapeKey);

        // Handle window resize
        window.addEventListener("resize", handleResize);

        // Add ripple effect to menu items
        addRippleEffect();

        // Mark active menu item based on current URL
        markActiveMenuItem();
    }

    /**
     * Open sidebar (mobile)
     */
    function openSidebar() {
        if (!sidebar || !overlay) return;

        sidebar.classList.remove("-translate-x-full");
        sidebar.classList.add("translate-x-0", "open");

        overlay.classList.remove("hidden");
        setTimeout(() => {
            overlay.style.opacity = "1";
        }, 10);

        document.body.style.overflow = "hidden";
    }

    /**
     * Close sidebar (mobile)
     */
    function closeSidebar() {
        if (!sidebar || !overlay) return;

        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0", "open");

        overlay.style.opacity = "0";
        setTimeout(() => {
            overlay.classList.add("hidden");
        }, 300);

        document.body.style.overflow = "";
    }

    /**
     * Handle escape key press
     */
    function handleEscapeKey(e) {
        if (
            e.key === "Escape" &&
            sidebar &&
            sidebar.classList.contains("translate-x-0")
        ) {
            closeSidebar();
        }
    }

    /**
     * Handle window resize
     */
    function handleResize() {
        if (!sidebar) return;

        if (window.innerWidth >= 1024) {
            // Desktop view
            sidebar.classList.remove(
                "-translate-x-full",
                "translate-x-0",
                "open",
            );
            if (overlay) {
                overlay.classList.add("hidden");
                overlay.style.opacity = "0";
            }
            document.body.style.overflow = "";
        } else {
            // Mobile view
            if (!sidebar.classList.contains("open")) {
                sidebar.classList.add("-translate-x-full");
            }
        }
    }

    /**
     * Add ripple effect to menu items
     */
    function addRippleEffect() {
        const menuItems = document.querySelectorAll(".menu-item");

        menuItems.forEach((item) => {
            item.addEventListener("click", function (e) {
                // Add press effect
                this.style.transform = "scale(0.98)";
                setTimeout(() => {
                    this.style.transform = "";
                }, 150);

                // Create ripple effect
                const ripple = document.createElement("span");
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + "px";
                ripple.style.left = x + "px";
                ripple.style.top = y + "px";
                ripple.className = "ripple";

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    }

    /**
     * Mark active menu item based on current URL
     */
    function markActiveMenuItem() {
        const currentUrl = window.location.pathname;
        const menuItems = document.querySelectorAll(".menu-item");

        menuItems.forEach((item) => {
            const href = item.getAttribute("href");
            if (href && currentUrl.includes(href) && href !== "#") {
                item.classList.add("active");
            }
        });
    }

    /**
     * Toggle submenu
     */
    function toggleSubmenu(button) {
        const submenu = button.nextElementSibling;
        const icon = button.querySelector(".fa-chevron-down");

        if (submenu && submenu.classList.contains("submenu-container")) {
            submenu.classList.toggle("hidden");
            icon.classList.toggle("rotate-180");
        }
    }

    // Public API
    return {
        init: init,
        open: openSidebar,
        close: closeSidebar,
        toggleSubmenu: toggleSubmenu,
    };
})();

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    Sidebar.init();
});

// Export for use in other scripts
if (typeof module !== "undefined" && module.exports) {
    module.exports = Sidebar;
}
