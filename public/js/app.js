/**
 * MAIN JAVASCRIPT - Sparepart Jawi
 * Mengimport semua file JavaScript
 */

// Import modules
import "./sidebar.js";
import "./header.js";
import "./components/charts.js";
import "./components/modals.js";
import "./pages/dashboard.js";
import "./pages/users.js";
import "./pages/spareparts.js"; // <-- TAMBAHKAN INI
import "./utils/helpers.js";
import "./utils/format.js";
import "./utils/api.js"; // <-- TAMBAHKAN INI
import "./vendors/chart.js"; // <-- TAMBAHKAN INI

// Global utility functions
window.formatRupiah = function (angka) {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  }).format(angka);
};

window.showToast = function (message, type = "success") {
  const toast = document.createElement("div");
  toast.className = `toast toast-${type}`;
  toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${type === "success" ? "fa-check-circle" : "fa-exclamation-circle"} mr-3"></i>
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
        animation: slideIn 0.3s ease;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
    `;

  document.body.appendChild(toast);

  setTimeout(() => {
    toast.style.animation = "slideOut 0.3s ease";
    setTimeout(() => toast.remove(), 300);
  }, 3000);
};

// Add animation styles
const style = document.createElement("style");
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Handle AJAX requests with CSRF token
window.axios = axios?.create({
  headers: {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content,
    "X-Requested-With": "XMLHttpRequest",
  },
});

// Export helpers to global scope if not already defined
if (typeof Helpers === "undefined") {
  window.Helpers = {
    formatRupiah: window.formatRupiah,
    showToast: window.showToast,
  };
}

console.log("App JS loaded successfully with all modules");
