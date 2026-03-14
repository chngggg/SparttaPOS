/**
 * Header JavaScript - Sparepart Jawi
 * Handles header interactions, dropdowns, and live clock
 */

const Header = (function () {
    // Private variables
    let clockInterval = null;

    /**
     * Initialize header components
     */
    function init() {
        // Start live clock
        startLiveClock();

        // Initialize mobile search toggle
        initMobileSearch();

        // Initialize dropdowns
        initDropdowns();

        // Initialize search functionality
        initSearch();
    }

    /**
     * Start live clock update
     */
    function startLiveClock() {
        const clockElement = document.getElementById("live-time");
        if (!clockElement) return;

        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString("id-ID", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
            });
            clockElement.textContent = timeString;
        }

        updateClock();
        clockInterval = setInterval(updateClock, 1000);
    }

    /**
     * Initialize mobile search toggle
     */
    function initMobileSearch() {
        const searchBtn = document.querySelector(".mobile-search-btn");
        const mobileSearch = document.querySelector(".mobile-search-bar");

        if (!searchBtn || !mobileSearch) return;

        searchBtn.addEventListener("click", function () {
            mobileSearch.classList.toggle("show");

            // Focus on search input when shown
            if (mobileSearch.classList.contains("show")) {
                const input = mobileSearch.querySelector("input");
                if (input) input.focus();
            }
        });
    }

    /**
     * Initialize dropdowns with click outside to close
     */
    function initDropdowns() {
        const dropdowns = document.querySelectorAll(".dropdown-container");

        dropdowns.forEach((container) => {
            const button = container.querySelector("button");
            const menu = container.querySelector(
                ".dropdown-menu, .user-dropdown",
            );

            if (!button || !menu) return;

            // Toggle on click
            button.addEventListener("click", function (e) {
                e.stopPropagation();

                // Close other dropdowns
                dropdowns.forEach((other) => {
                    if (other !== container) {
                        other
                            .querySelector(".dropdown-menu, .user-dropdown")
                            ?.classList.remove("show");
                    }
                });

                menu.classList.toggle("show");
            });

            // Close on click outside
            document.addEventListener("click", function (e) {
                if (!container.contains(e.target)) {
                    menu.classList.remove("show");
                }
            });
        });
    }

    /**
     * Initialize search functionality
     */
    function initSearch() {
        const searchInputs = document.querySelectorAll(".search-input");

        searchInputs.forEach((input) => {
            let debounceTimer;

            input.addEventListener("input", function () {
                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {
                    performSearch(this.value);
                }, 300);
            });

            input.addEventListener("focus", function () {
                const results =
                    this.closest(".search-wrapper")?.querySelector(
                        ".search-results",
                    );
                if (results && this.value.length > 0) {
                    results.style.display = "block";
                }
            });
        });

        // Close search results when clicking outside
        document.addEventListener("click", function (e) {
            if (!e.target.closest(".search-wrapper")) {
                document.querySelectorAll(".search-results").forEach((el) => {
                    el.style.display = "none";
                });
            }
        });
    }

    /**
     * Perform search (placeholder - implement actual search)
     */
    function performSearch(query) {
        if (query.length < 2) return;

        console.log("Searching for:", query);
        // Implement actual search logic here
        // This would typically be an API call
    }

    /**
     * Clean up intervals
     */
    function destroy() {
        if (clockInterval) {
            clearInterval(clockInterval);
        }
    }

    // Public API
    return {
        init: init,
        destroy: destroy,
    };
})();

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    Header.init();
});

// Clean up on page unload
window.addEventListener("beforeunload", function () {
    Header.destroy();
});

// Export for use in other scripts
if (typeof module !== "undefined" && module.exports) {
    module.exports = Header;
}
