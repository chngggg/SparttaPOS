/**
 * DASHBOARD SPECIFIC JAVASCRIPT
 * Hanya untuk fungsionalitas halaman dashboard
 */

const Dashboard = (function () {
    // Private variables
    let charts = {};

    /**
     * Initialize dashboard
     */
    function init() {
        // Hanya inisialisasi jika kita di halaman dashboard
        if (!document.querySelector(".dashboard-page")) return;

        console.log("Dashboard initialized");

        // Load animations untuk stat cards
        initCardAnimations();

        // Initialize tooltips
        initTooltips();

        // Initialize charts (placeholder)
        initCharts();

        // Initialize data refresh
        initDataRefresh();
    }

    /**
     * Animasi untuk stat cards
     */
    function initCardAnimations() {
        const cards = document.querySelectorAll(".dashboard-page .stat-card");

        cards.forEach((card, index) => {
            card.style.animation = `fadeIn 0.5s ease forwards ${index * 0.1}s`;
            card.style.opacity = "0";
        });

        // Add animation styles if not exists
        if (!document.getElementById("dashboard-animations")) {
            const style = document.createElement("style");
            style.id = "dashboard-animations";
            style.textContent = `
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    /**
     * Initialize tooltips untuk dashboard
     */
    function initTooltips() {
        const tooltips = document.querySelectorAll(
            ".dashboard-page [data-tooltip]",
        );

        tooltips.forEach((element) => {
            element.addEventListener("mouseenter", function (e) {
                const tooltip = document.createElement("div");
                tooltip.className = "dashboard-tooltip";
                tooltip.textContent = this.dataset.tooltip;
                tooltip.style.cssText = `
                    position: absolute;
                    background: #2c2420;
                    color: #f8f5f0;
                    padding: 4px 8px;
                    border-radius: 4px;
                    font-size: 12px;
                    z-index: 1000;
                    white-space: nowrap;
                    pointer-events: none;
                    transition: opacity 0.2s ease;
                `;

                document.body.appendChild(tooltip);

                const rect = this.getBoundingClientRect();
                tooltip.style.left =
                    rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + "px";
                tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + "px";

                this.addEventListener(
                    "mouseleave",
                    function onLeave() {
                        tooltip.remove();
                        this.removeEventListener("mouseleave", onLeave);
                    },
                    { once: true },
                );
            });
        });
    }

    /**
     * Initialize charts (placeholder untuk sekarang)
     */
    function initCharts() {
        // This will be replaced with actual chart implementation later
        console.log("Chart container ready for Chart.js integration");

        // Contoh: jika Chart.js tersedia, kita bisa inisialisasi
        if (typeof Chart !== "undefined") {
            // Inisialisasi chart di sini nanti
            console.log("Chart.js is available");
        }
    }

    /**
     * Initialize data refresh (untuk angka real-time)
     */
    function initDataRefresh() {
        // Refresh data setiap 30 detik (jika diperlukan)
        setInterval(() => {
            refreshStats();
        }, 30000);
    }

    /**
     * Refresh statistics via AJAX
     */
    function refreshStats() {
        // This will be implemented when we add AJAX later
        console.log("Refreshing stats...");
    }

    /**
     * Format currency
     */
    function formatRupiah(angka) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        })
            .format(angka)
            .replace("Rp", "Rp ");
    }

    /**
     * Show toast notification
     */
    function showToast(message, type = "success") {
        const toast = document.createElement("div");
        toast.className = `dashboard-toast dashboard-toast-${type}`;
        toast.innerHTML = `
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <i class="fas ${type === "success" ? "fa-check-circle" : "fa-exclamation-circle"}" style="font-size: 1.25rem;"></i>
                <span>${message}</span>
            </div>
        `;

        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: ${type === "success" ? "#10b981" : "#ef4444"};
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            z-index: 9999;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.3s ease;
            font-size: 14px;
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = "slideOut 0.3s ease";
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Public API
    return {
        init: init,
        formatRupiah: formatRupiah,
        showToast: showToast,
        refreshStats: refreshStats,
    };
})();

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    Dashboard.init();
});

// Export for use in other scripts
if (typeof module !== "undefined" && module.exports) {
    module.exports = Dashboard;
}
