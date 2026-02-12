/**
 * ERP System - Client-Side Utilities
 * 
 * Provides functionality for:
 * - Mobile menu navigation
 * - Modal management
 * - Form validation and submission
 * - Toast notifications
 * - Table utilities (sorting, filtering)
 * - Confirmation dialogs
 * - API helpers
 */

(function() {
    'use strict';

    // ============================================================================
    // MOBILE MENU TOGGLE
    // ============================================================================
    
    /**
     * Initialize mobile menu functionality
     */
    function initMobileMenu() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMobileMenu = document.getElementById('close-mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                mobileMenu.classList.toggle('translate-x-full');
            });
        }

        if (closeMobileMenu && mobileMenu) {
            closeMobileMenu.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.add('translate-x-full');
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (mobileMenu && !mobileMenu.contains(event.target) && 
                mobileMenuButton && !mobileMenuButton.contains(event.target)) {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.add('translate-x-full');
            }
        });
    }

    // ============================================================================
    // MODAL MANAGEMENT
    // ============================================================================

    window.Modal = {
        /**
         * Open a modal by ID
         */
        open: function(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        },

        /**
         * Close a modal by ID
         */
        close: function(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        },

        /**
         * Close all modals
         */
        closeAll: function() {
            document.querySelectorAll('[data-modal]').forEach(modal => {
                modal.classList.add('hidden');
            });
            document.body.style.overflow = '';
        }
    };

    // Initialize modal close buttons
    function initModals() {
        document.querySelectorAll('[data-modal-close]').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-modal-close');
                window.Modal.close(modalId);
            });
        });

        // Close modal on backdrop click
        document.querySelectorAll('[data-modal]').forEach(modal => {
            modal.addEventListener('click', function(event) {
                if (event.target === this) {
                    this.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        });
    }

    // ============================================================================
    // TOAST NOTIFICATIONS
    // ============================================================================

    window.Toast = {
        /**
         * Show a toast notification
         * @param {string} message - The message to display
         * @param {string} type - success, error, warning, info
         * @param {number} duration - Duration in ms (default 3000)
         */
        show: function(message, type = 'info', duration = 3000) {
            const container = this.getContainer();
            const toast = this.create(message, type);
            
            container.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => toast.classList.add('translate-x-0', 'opacity-100'), 10);
            
            // Auto remove
            setTimeout(() => {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, duration);
        },

        /**
         * Get or create toast container
         */
        getContainer: function() {
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'fixed top-4 right-4 z-50 space-y-2';
                document.body.appendChild(container);
            }
            return container;
        },

        /**
         * Create toast element
         */
        create: function(message, type) {
            const toast = document.createElement('div');
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };
            
            toast.className = `${colors[type] || colors.info} text-white px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full opacity-0 max-w-sm`;
            toast.innerHTML = `
                <div class="flex items-center space-x-3">
                    <span class="flex-1">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-gray-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            `;
            return toast;
        },

        success: function(message, duration) { this.show(message, 'success', duration); },
        error: function(message, duration) { this.show(message, 'error', duration); },
        warning: function(message, duration) { this.show(message, 'warning', duration); },
        info: function(message, duration) { this.show(message, 'info', duration); }
    };

    // ============================================================================
    // CONFIRMATION DIALOGS
    // ============================================================================

    window.Confirm = {
        /**
         * Show confirmation dialog
         * @param {string} message - Confirmation message
         * @param {function} onConfirm - Callback if confirmed
         * @param {function} onCancel - Callback if cancelled
         */
        show: function(message, onConfirm, onCancel) {
            const overlay = document.createElement('div');
            overlay.className = 'fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center';
            overlay.innerHTML = `
                <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Confirm Action</h3>
                    <p class="text-gray-600 mb-6">${message}</p>
                    <div class="flex justify-end space-x-3">
                        <button data-action="cancel" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-medium transition">
                            Cancel
                        </button>
                        <button data-action="confirm" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                            Confirm
                        </button>
                    </div>
                </div>
            `;

            document.body.appendChild(overlay);

            overlay.querySelector('[data-action="confirm"]').addEventListener('click', function() {
                overlay.remove();
                if (onConfirm) onConfirm();
            });

            overlay.querySelector('[data-action="cancel"]').addEventListener('click', function() {
                overlay.remove();
                if (onCancel) onCancel();
            });

            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    overlay.remove();
                    if (onCancel) onCancel();
                }
            });
        }
    };

    // ============================================================================
    // FORM VALIDATION
    // ============================================================================

    window.FormValidator = {
        /**
         * Validate a form
         * @param {HTMLFormElement} form - The form to validate
         * @returns {boolean} - True if valid
         */
        validate: function(form) {
            let isValid = true;
            const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    this.showError(input, 'This field is required');
                    isValid = false;
                } else {
                    this.clearError(input);
                }
            });

            // Email validation
            const emailInputs = form.querySelectorAll('input[type="email"]');
            emailInputs.forEach(input => {
                if (input.value && !this.isValidEmail(input.value)) {
                    this.showError(input, 'Please enter a valid email address');
                    isValid = false;
                }
            });

            return isValid;
        },

        /**
         * Show error message for input
         */
        showError: function(input, message) {
            const errorDiv = input.parentElement.querySelector('.error-message');
            if (errorDiv) errorDiv.remove();

            const error = document.createElement('div');
            error.className = 'error-message text-red-600 text-sm mt-1';
            error.textContent = message;
            input.parentElement.appendChild(error);
            input.classList.add('border-red-500');
        },

        /**
         * Clear error message for input
         */
        clearError: function(input) {
            const errorDiv = input.parentElement.querySelector('.error-message');
            if (errorDiv) errorDiv.remove();
            input.classList.remove('border-red-500');
        },

        /**
         * Validate email format
         */
        isValidEmail: function(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
    };

    // ============================================================================
    // API HELPER
    // ============================================================================

    window.API = {
        /**
         * Make an API request
         * @param {string} url - API endpoint
         * @param {object} options - Fetch options
         * @returns {Promise}
         */
        request: async function(url, options = {}) {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            };

            const config = { ...defaultOptions, ...options };
            
            try {
                const response = await fetch(url, config);
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.error || 'Request failed');
                }
                
                return data;
            } catch (error) {
                console.error('API Error:', error);
                throw error;
            }
        },

        get: function(url) {
            return this.request(url, { method: 'GET' });
        },

        post: function(url, data) {
            return this.request(url, {
                method: 'POST',
                body: JSON.stringify(data)
            });
        },

        put: function(url, data) {
            return this.request(url, {
                method: 'PUT',
                body: JSON.stringify(data)
            });
        },

        delete: function(url) {
            return this.request(url, { method: 'DELETE' });
        }
    };

    // ============================================================================
    // TABLE UTILITIES
    // ============================================================================

    window.Table = {
        /**
         * Sort table by column
         */
        sort: function(table, columnIndex, ascending = true) {
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim();
                const bText = b.cells[columnIndex].textContent.trim();
                
                if (ascending) {
                    return aText.localeCompare(bText);
                } else {
                    return bText.localeCompare(aText);
                }
            });

            rows.forEach(row => tbody.appendChild(row));
        },

        /**
         * Filter table rows
         */
        filter: function(table, searchText) {
            const tbody = table.querySelector('tbody');
            const rows = tbody.querySelectorAll('tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchText.toLowerCase())) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    };

    // ============================================================================
    // INITIALIZATION
    // ============================================================================

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize mobile menu
        initMobileMenu();

        // Initialize modals
        initModals();

        // Initialize form validation on submit
        document.querySelectorAll('form[data-validate]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!window.FormValidator.validate(this)) {
                    e.preventDefault();
                }
            });
        });

        // Auto-hide flash messages after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.flash-message').forEach(function(flash) {
                flash.style.opacity = '0';
                flash.style.transition = 'opacity 0.5s';
                setTimeout(() => flash.remove(), 500);
            });
        }, 5000);

        // Initialize table search if present
        const tableSearch = document.getElementById('table-search');
        if (tableSearch) {
            const table = document.querySelector('table');
            tableSearch.addEventListener('input', function() {
                window.Table.filter(table, this.value);
            });
        }

        // Add loading indicator for async operations
        window.showLoading = function() {
            const loader = document.createElement('div');
            loader.id = 'global-loader';
            loader.className = 'fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center';
            loader.innerHTML = `
                <div class="bg-white rounded-lg p-6 shadow-xl">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-4 text-gray-600">Loading...</p>
                </div>
            `;
            document.body.appendChild(loader);
        };

        window.hideLoading = function() {
            const loader = document.getElementById('global-loader');
            if (loader) loader.remove();
        };
    });

    // ============================================================================
    // UTILITY FUNCTIONS
    // ============================================================================

    /**
     * Format currency
     */
    window.formatCurrency = function(amount) {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD'
        }).format(amount);
    };

    /**
     * Format date
     */
    window.formatDate = function(dateString) {
        return new Date(dateString).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    };

    /**
     * Debounce function
     */
    window.debounce = function(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    };

})();
