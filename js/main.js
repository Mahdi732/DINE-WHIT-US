/**
 * Dine With Us - Main JavaScript Module
 * Modern ES6+ implementation with form validation and UI interactions
 */

// ===== DOM Ready =====
document.addEventListener('DOMContentLoaded', () => {
    initLoginTabs();
    initPasswordToggle();
    initPasswordStrength();
    initFormValidation();
    initScrollAnimations();
    initMobileMenu();
    initReservationForm();
});

// ===== Login/Signup Tab Switching =====
function initLoginTabs() {
    const loginTab = document.getElementById('loginTab');
    const signupTab = document.getElementById('signupTab');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    
    if (!loginTab || !signupTab) return;
    
    loginTab.addEventListener('click', () => {
        loginForm?.classList.remove('hidden');
        signupForm?.classList.add('hidden');
        loginTab.classList.add('bg-white/10', 'text-white');
        loginTab.classList.remove('text-gray-400');
        signupTab.classList.remove('bg-white/10', 'text-white');
        signupTab.classList.add('text-gray-400');
    });
    
    signupTab.addEventListener('click', () => {
        loginForm?.classList.add('hidden');
        signupForm?.classList.remove('hidden');
        signupTab.classList.add('bg-white/10', 'text-white');
        signupTab.classList.remove('text-gray-400');
        loginTab.classList.remove('bg-white/10', 'text-white');
        loginTab.classList.add('text-gray-400');
    });
}

// ===== Password Visibility Toggle =====
function initPasswordToggle() {
    document.querySelectorAll('[data-toggle-password]').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.togglePassword;
            const input = document.getElementById(targetId);
            if (!input) return;
            
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            
            // Update icon
            const showIcon = button.querySelector('.icon-show');
            const hideIcon = button.querySelector('.icon-hide');
            if (showIcon && hideIcon) {
                showIcon.classList.toggle('hidden', !isPassword);
                hideIcon.classList.toggle('hidden', isPassword);
            }
        });
    });
}

// ===== Password Strength Indicator =====
function initPasswordStrength() {
    const passwordInputs = document.querySelectorAll('input[type="password"][data-strength]');
    
    passwordInputs.forEach(input => {
        const strengthBar = document.getElementById(input.dataset.strength);
        const strengthText = document.getElementById(input.dataset.strengthText);
        
        if (!strengthBar) return;
        
        input.addEventListener('input', () => {
            const strength = calculatePasswordStrength(input.value);
            updateStrengthIndicator(strengthBar, strengthText, strength);
        });
    });
}

function calculatePasswordStrength(password) {
    let score = 0;
    
    if (password.length === 0) return { score: 0, label: '', color: '' };
    if (password.length >= 8) score++;
    if (password.length >= 12) score++;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
    if (/\d/.test(password)) score++;
    if (/[^a-zA-Z0-9]/.test(password)) score++;
    
    const levels = [
        { score: 0, label: 'Very Weak', color: 'bg-red-500' },
        { score: 1, label: 'Weak', color: 'bg-orange-500' },
        { score: 2, label: 'Fair', color: 'bg-yellow-500' },
        { score: 3, label: 'Good', color: 'bg-lime-500' },
        { score: 4, label: 'Strong', color: 'bg-green-500' },
        { score: 5, label: 'Very Strong', color: 'bg-emerald-500' }
    ];
    
    return levels[Math.min(score, 5)];
}

function updateStrengthIndicator(bar, text, strength) {
    const percentage = (strength.score / 5) * 100;
    bar.style.width = `${percentage}%`;
    bar.className = `h-full rounded-full transition-all duration-300 ${strength.color}`;
    
    if (text) {
        text.textContent = strength.label;
        text.className = `text-xs mt-1 ${strength.color.replace('bg-', 'text-')}`;
    }
}

// ===== Form Validation =====
function initFormValidation() {
    // Signup form validation
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', (e) => {
            const errors = validateSignupForm(signupForm);
            if (errors.length > 0) {
                e.preventDefault();
                showFormErrors(errors);
                return false;
            }
        });
    }
    
    // Real-time email validation
    document.querySelectorAll('input[type="email"]').forEach(input => {
        input.addEventListener('blur', () => {
            const isValid = validateEmail(input.value);
            toggleInputError(input, !isValid && input.value.length > 0, 'Please enter a valid email address');
        });
    });
    
    // Password confirmation matching
    const confirmPassword = document.getElementById('confirmPassword');
    if (confirmPassword) {
        confirmPassword.addEventListener('input', () => {
            const password = document.getElementById('signupPassword');
            const matches = password && password.value === confirmPassword.value;
            toggleInputError(confirmPassword, !matches && confirmPassword.value.length > 0, 'Passwords do not match');
        });
    }
}

function validateSignupForm(form) {
    const errors = [];
    const formData = new FormData(form);
    
    // Required fields
    const requiredFields = ['nom', 'prenom', 'email', 'password', 'confirmPassword'];
    requiredFields.forEach(field => {
        const value = formData.get(field);
        if (!value || value.trim() === '') {
            errors.push(`${field.replace(/([A-Z])/g, ' $1').trim()} is required`);
        }
    });
    
    // Email validation
    const email = formData.get('email');
    if (email && !validateEmail(email)) {
        errors.push('Please enter a valid email address');
    }
    
    // Password validation
    const password = formData.get('password');
    if (password && password.length < 6) {
        errors.push('Password must be at least 6 characters');
    }
    
    // Password match
    const confirmPassword = formData.get('confirmPassword');
    if (password !== confirmPassword) {
        errors.push('Passwords do not match');
    }
    
    // Terms checkbox
    const terms = form.querySelector('input[type="checkbox"][name="terms"]');
    if (terms && !terms.checked) {
        errors.push('You must accept the terms and conditions');
    }
    
    return errors;
}

function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function toggleInputError(input, hasError, message = '') {
    const wrapper = input.closest('.input-wrapper') || input.parentElement;
    let errorElement = wrapper.querySelector('.input-error');
    
    if (hasError) {
        input.classList.add('border-red-500', 'focus:ring-red-500');
        input.classList.remove('border-white/20', 'focus:ring-brand-500');
        
        if (!errorElement && message) {
            errorElement = document.createElement('p');
            errorElement.className = 'input-error text-xs text-red-400 mt-1';
            errorElement.textContent = message;
            wrapper.appendChild(errorElement);
        }
    } else {
        input.classList.remove('border-red-500', 'focus:ring-red-500');
        input.classList.add('border-white/20', 'focus:ring-brand-500');
        errorElement?.remove();
    }
}

function showFormErrors(errors) {
    // Remove existing error container
    const existingErrors = document.querySelector('.form-errors');
    existingErrors?.remove();
    
    // Create error container
    const container = document.createElement('div');
    container.className = 'form-errors bg-red-500/20 border border-red-500/50 rounded-xl p-4 mb-6';
    container.innerHTML = `
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-medium text-red-400 mb-2">Please correct the following errors:</p>
                <ul class="text-sm text-red-300 space-y-1">
                    ${errors.map(e => `<li>• ${e}</li>`).join('')}
                </ul>
            </div>
        </div>
    `;
    
    // Insert at top of form
    const form = document.querySelector('form:not(.hidden)');
    form?.insertBefore(container, form.firstChild);
    
    // Scroll to errors
    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// ===== Scroll Animations =====
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('[data-animate]').forEach(el => {
        el.classList.add('opacity-0', 'translate-y-4');
        observer.observe(el);
    });
}

// ===== Mobile Menu =====
function initMobileMenu() {
    const menuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (!menuToggle || !mobileMenu) return;
    
    menuToggle.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden', isOpen);
        
        // Toggle icon
        const openIcon = menuToggle.querySelector('.icon-open');
        const closeIcon = menuToggle.querySelector('.icon-close');
        openIcon?.classList.toggle('hidden', !isOpen);
        closeIcon?.classList.toggle('hidden', isOpen);
    });
    
    // Close on click outside
    document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !menuToggle.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
}

// ===== Reservation Form =====
function initReservationForm() {
    const form = document.getElementById('reservationForm');
    if (!form) return;
    
    // Set minimum date to today
    const dateInput = form.querySelector('input[type="date"]');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
    
    // Validate on submit
    form.addEventListener('submit', (e) => {
        const date = form.querySelector('input[name="date"]')?.value;
        const time = form.querySelector('input[name="time"]')?.value;
        const guests = form.querySelector('input[name="guests"]')?.value;
        
        const errors = [];
        
        if (!date) errors.push('Please select a date');
        if (!time) errors.push('Please select a time');
        if (!guests || guests < 1 || guests > 20) {
            errors.push('Please enter a valid number of guests (1-20)');
        }
        
        // Validate date is in future
        if (date && new Date(date) < new Date().setHours(0, 0, 0, 0)) {
            errors.push('Please select a future date');
        }
        
        if (errors.length > 0) {
            e.preventDefault();
            showFormErrors(errors);
        }
    });
}

// ===== Utility Functions =====
const Utils = {
    // Debounce function for performance
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },
    
    // Format date for display
    formatDate(date) {
        return new Date(date).toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    },
    
    // Show toast notification
    toast(message, type = 'info') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            warning: 'bg-yellow-500',
            info: 'bg-blue-500'
        };
        
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-y-full opacity-0 transition-all duration-300`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Animate in
        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-full', 'opacity-0');
        });
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-y-full', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    },
    
    // Smooth scroll to element
    scrollTo(selector) {
        const element = document.querySelector(selector);
        element?.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};

// Make Utils available globally
window.Utils = Utils;

// ===== CSS Injection for Animations =====
const style = document.createElement('style');
style.textContent = `
    .animate-in {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .input-wrapper {
        position: relative;
    }
    
    /* Smooth transitions for all interactive elements */
    button, a, input, select, textarea {
        transition: all 0.2s ease;
    }
`;
document.head.appendChild(style);

