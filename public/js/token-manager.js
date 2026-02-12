/**
 * Token Management & Auto-Logout System
 * 
 * Manages JWT tokens in localStorage and handles automatic logout
 * when tokens expire or become invalid.
 */

(function() {
    'use strict';

    const TokenManager = {
        // Storage keys
        ACCESS_TOKEN_KEY: 'erp_access_token',
        REFRESH_TOKEN_KEY: 'erp_refresh_token',
        TOKEN_EXPIRY_KEY: 'erp_token_expiry',
        USER_DATA_KEY: 'erp_user_data',

        // Check interval (every 30 seconds)
        CHECK_INTERVAL: 30000,

        // Warning before expiry (5 minutes)
        WARNING_THRESHOLD: 300000,

        checkInterval: null,
        warningShown: false,

        /**
         * Initialize token management system
         */
        init() {
            this.startMonitoring();
            this.checkTokenOnPageLoad();
            
            // Listen for storage events (multi-tab sync)
            window.addEventListener('storage', (e) => {
                if (e.key === this.ACCESS_TOKEN_KEY || e.key === this.TOKEN_EXPIRY_KEY) {
                    this.checkTokenValidity();
                }
            });

            // Check before unload
            window.addEventListener('beforeunload', () => {
                this.stopMonitoring();
            });

            console.log('TokenManager initialized');
        },

        /**
         * Store tokens in localStorage
         */
        setTokens(accessToken, refreshToken, expiresIn = 3600) {
            try {
                localStorage.setItem(this.ACCESS_TOKEN_KEY, accessToken);
                
                if (refreshToken) {
                    localStorage.setItem(this.REFRESH_TOKEN_KEY, refreshToken);
                }

                // Calculate expiry timestamp
                const expiryTime = Date.now() + (expiresIn * 1000);
                localStorage.setItem(this.TOKEN_EXPIRY_KEY, expiryTime.toString());

                this.warningShown = false;
                console.log('Tokens stored successfully');
            } catch (error) {
                console.error('Error storing tokens:', error);
            }
        },

        /**
         * Get access token from localStorage
         */
        getAccessToken() {
            return localStorage.getItem(this.ACCESS_TOKEN_KEY);
        },

        /**
         * Get refresh token from localStorage
         */
        getRefreshToken() {
            return localStorage.getItem(this.REFRESH_TOKEN_KEY);
        },

        /**
         * Get token expiry timestamp
         */
        getTokenExpiry() {
            const expiry = localStorage.getItem(this.TOKEN_EXPIRY_KEY);
            return expiry ? parseInt(expiry, 10) : null;
        },

        /**
         * Check if token is expired
         */
        isTokenExpired() {
            const expiryTime = this.getTokenExpiry();
            if (!expiryTime) return true;
            return Date.now() >= expiryTime;
        },

        /**
         * Get time until token expires (in milliseconds)
         */
        getTimeUntilExpiry() {
            const expiryTime = this.getTokenExpiry();
            if (!expiryTime) return 0;
            return Math.max(0, expiryTime - Date.now());
        },

        /**
         * Store user data
         */
        setUserData(userData) {
            try {
                localStorage.setItem(this.USER_DATA_KEY, JSON.stringify(userData));
            } catch (error) {
                console.error('Error storing user data:', error);
            }
        },

        /**
         * Get user data
         */
        getUserData() {
            try {
                const data = localStorage.getItem(this.USER_DATA_KEY);
                return data ? JSON.parse(data) : null;
            } catch (error) {
                console.error('Error retrieving user data:', error);
                return null;
            }
        },

        /**
         * Clear all tokens and user data
         */
        clearTokens() {
            localStorage.removeItem(this.ACCESS_TOKEN_KEY);
            localStorage.removeItem(this.REFRESH_TOKEN_KEY);
            localStorage.removeItem(this.TOKEN_EXPIRY_KEY);
            localStorage.removeItem(this.USER_DATA_KEY);
            console.log('Tokens cleared');
        },

        /**
         * Check token validity on page load
         */
        checkTokenOnPageLoad() {
            if (this.isTokenExpired()) {
                const currentPath = window.location.pathname;
                const publicPaths = ['/', '/login', '/register'];
                
                // Only auto-logout if not on public pages
                if (!publicPaths.includes(currentPath)) {
                    console.log('Token expired on page load');
                    this.handleTokenExpiry();
                }
            }
        },

        /**
         * Check token validity
         */
        checkTokenValidity() {
            if (!this.getAccessToken()) {
                return; // No token, user not logged in
            }

            const timeUntilExpiry = this.getTimeUntilExpiry();

            // Token expired
            if (timeUntilExpiry === 0) {
                this.handleTokenExpiry();
                return;
            }

            // Show warning before expiry
            if (timeUntilExpiry <= this.WARNING_THRESHOLD && !this.warningShown) {
                this.showExpiryWarning(timeUntilExpiry);
                this.warningShown = true;
            }
        },

        /**
         * Show expiry warning to user
         */
        showExpiryWarning(timeRemaining) {
            const minutes = Math.ceil(timeRemaining / 60000);
            
            if (window.showNotification) {
                window.showNotification(
                    `Your session will expire in ${minutes} minute${minutes !== 1 ? 's' : ''}. Please save your work.`,
                    'warning'
                );
            } else {
                console.warn(`Session expiring in ${minutes} minutes`);
            }
        },

        /**
         * Handle token expiry
         */
        handleTokenExpiry() {
            this.clearTokens();
            
            if (window.showNotification) {
                window.showNotification('Your session has expired. Please log in again.', 'error');
            }

            // Redirect to login after short delay
            setTimeout(() => {
                window.location.href = '/login?expired=1';
            }, 2000);
        },

        /**
         * Attempt to refresh token
         */
        async refreshTokens() {
            const refreshToken = this.getRefreshToken();
            
            if (!refreshToken) {
                this.handleTokenExpiry();
                return false;
            }

            try {
                const response = await fetch('/api/auth/refresh', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ refresh_token: refreshToken })
                });

                if (!response.ok) {
                    throw new Error('Token refresh failed');
                }

                const data = await response.json();
                
                if (data.access_token) {
                    this.setTokens(
                        data.access_token,
                        data.refresh_token || refreshToken,
                        data.expires_in || 3600
                    );
                    
                    console.log('Tokens refreshed successfully');
                    return true;
                } else {
                    throw new Error('Invalid response from refresh endpoint');
                }
            } catch (error) {
                console.error('Token refresh error:', error);
                this.handleTokenExpiry();
                return false;
            }
        },

        /**
         * Start monitoring tokens
         */
        startMonitoring() {
            if (this.checkInterval) {
                return; // Already monitoring
            }

            // Check immediately
            this.checkTokenValidity();

            // Check periodically
            this.checkInterval = setInterval(() => {
                this.checkTokenValidity();
            }, this.CHECK_INTERVAL);

            console.log('Token monitoring started');
        },

        /**
         * Stop monitoring tokens
         */
        stopMonitoring() {
            if (this.checkInterval) {
                clearInterval(this.checkInterval);
                this.checkInterval = null;
                console.log('Token monitoring stopped');
            }
        },

        /**
         * Add authorization header to fetch requests
         */
        addAuthHeader(headers = {}) {
            const token = this.getAccessToken();
            if (token) {
                headers['Authorization'] = `Bearer ${token}`;
            }
            return headers;
        },

        /**
         * Authenticated fetch wrapper
         */
        async authFetch(url, options = {}) {
            const token = this.getAccessToken();
            
            if (!token) {
                throw new Error('No access token available');
            }

            options.headers = this.addAuthHeader(options.headers || {});

            try {
                const response = await fetch(url, options);
                
                // Handle 401 Unauthorized (token expired)
                if (response.status === 401) {
                    // Try to refresh token
                    const refreshed = await this.refreshTokens();
                    
                    if (refreshed) {
                        // Retry request with new token
                        options.headers = this.addAuthHeader(options.headers);
                        return await fetch(url, options);
                    } else {
                        throw new Error('Authentication failed');
                    }
                }

                return response;
            } catch (error) {
                console.error('Auth fetch error:', error);
                throw error;
            }
        }
    };

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => TokenManager.init());
    } else {
        TokenManager.init();
    }

    // Export to global scope
    window.TokenManager = TokenManager;

})();
