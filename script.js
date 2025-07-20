// Future Frontiers HQ - Interactive Features

// DOM Elements
const articleCards = document.querySelectorAll('.article-card');
const newsletterForm = document.querySelector('form');
const newsletterInput = document.querySelector('input[type="email"]');

// Initialize animations on page load
document.addEventListener('DOMContentLoaded', function() {
    // Fade in article cards
    animateArticleCards();
    
    // Add scroll animations
    initScrollAnimations();
    
    // Initialize newsletter form
    initNewsletterForm();
    
    // Add hover effects
    addHoverEffects();
});

// Animate article cards on load
function animateArticleCards() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('fade-in');
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    articleCards.forEach(card => {
        observer.observe(card);
    });
}

// Initialize scroll animations
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.hero-gradient, .article-card');
    
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = '0s';
                entry.target.style.animationFillMode = 'forwards';
            }
        });
    }, {
        threshold: 0.1
    });

    animatedElements.forEach(element => {
        scrollObserver.observe(element);
    });
}

// Newsletter form handling
function initNewsletterForm() {
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', handleNewsletterSubmit);
    }
}

// Handle newsletter subscription
function handleNewsletterSubmit(e) {
    e.preventDefault();
    
    const email = newsletterInput.value.trim();
    
    if (!isValidEmail(email)) {
        showNotification('Please enter a valid email address', 'error');
        return;
    }
    
    // Show loading state
    const submitButton = e.target.querySelector('button[type="submit"]');
    const originalText = submitButton.textContent;
    submitButton.textContent = 'Subscribing...';
    submitButton.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        showNotification('Successfully subscribed to Future Frontiers HQ!', 'success');
        newsletterInput.value = '';
        submitButton.textContent = originalText;
        submitButton.disabled = false;
    }, 1500);
}

// Email validation
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Show notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    
    // Style the notification
    Object.assign(notification.style, {
        position: 'fixed',
        top: '20px',
        right: '20px',
        padding: '1rem 1.5rem',
        borderRadius: '0.5rem',
        color: 'white',
        fontWeight: '600',
        zIndex: '1000',
        transform: 'translateX(100%)',
        transition: 'transform 0.3s ease'
    });
    
    if (type === 'success') {
        notification.style.backgroundColor = '#10b981';
    } else if (type === 'error') {
        notification.style.backgroundColor = '#ef4444';
    }
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Add hover effects to article cards
function addHoverEffects() {
    articleCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// Lazy loading for images
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

// Search functionality (future enhancement)
function initSearch() {
    const searchInput = document.createElement('input');
    searchInput.type = 'text';
    searchInput.placeholder = 'Search articles...';
    searchInput.className = 'search-input';
    
    // Add search styles
    Object.assign(searchInput.style, {
        padding: '0.5rem 1rem',
        border: '1px solid #e5e7eb',
        borderRadius: '0.5rem',
        marginLeft: '1rem'
    });
    
    // Add to header
    const nav = document.querySelector('nav');
    if (nav) {
        nav.appendChild(searchInput);
    }
    
    // Add search functionality
    searchInput.addEventListener('input', debounce(handleSearch, 300));
}

// Search handler
function handleSearch(e) {
    const query = e.target.value.toLowerCase();
    const articles = document.querySelectorAll('.article-card');
    
    articles.forEach(article => {
        const title = article.querySelector('h3').textContent.toLowerCase();
        const content = article.querySelector('p').textContent.toLowerCase();
        
        if (title.includes(query) || content.includes(query)) {
            article.style.display = 'block';
        } else {
            article.style.display = 'none';
        }
    });
}

// Debounce function for search
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Reading time calculator
function calculateReadingTime() {
    const articles = document.querySelectorAll('.article-card');
    
    articles.forEach(article => {
        const content = article.querySelector('p').textContent;
        const wordsPerMinute = 200;
        const wordCount = content.split(' ').length;
        const readingTime = Math.ceil(wordCount / wordsPerMinute);
        
        const readingTimeElement = document.createElement('span');
        readingTimeElement.className = 'reading-time';
        readingTimeElement.textContent = `${readingTime} min read`;
        readingTimeElement.style.fontSize = '0.75rem';
        readingTimeElement.style.color = '#6b7280';
        
        const meta = article.querySelector('.flex.items-center');
        if (meta) {
            meta.appendChild(readingTimeElement);
        }
    });
}

// Share functionality
function addShareButtons() {
    const articles = document.querySelectorAll('.article-card');
    
    articles.forEach(article => {
        const shareButton = document.createElement('button');
        shareButton.className = 'share-button';
        shareButton.innerHTML = 'Share';
        shareButton.style.cssText = `
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 0.875rem;
            margin-left: auto;
        `;
        
        shareButton.addEventListener('click', () => {
            const title = article.querySelector('h3').textContent;
            const url = window.location.href;
            
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                // Fallback for browsers without native sharing
                navigator.clipboard.writeText(url);
                showNotification('Link copied to clipboard!', 'success');
            }
        });
        
        const meta = article.querySelector('.flex.items-center');
        if (meta) {
            meta.appendChild(shareButton);
        }
    });
}

// Dark mode toggle (future enhancement)
function initDarkMode() {
    const darkModeToggle = document.createElement('button');
    darkModeToggle.innerHTML = '🌙';
    darkModeToggle.className = 'dark-mode-toggle';
    darkModeToggle.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: linear-gradient(135deg, #00D4FF, #FF006E);
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
    `;
    
    darkModeToggle.addEventListener('click', toggleDarkMode);
    document.body.appendChild(darkModeToggle);
}

// Dark mode functionality
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    const isDark = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDark);
}

// Load saved dark mode preference
function loadDarkModePreference() {
    const isDark = localStorage.getItem('darkMode') === 'true';
    if (isDark) {
        document.body.classList.add('dark-mode');
    }
}

// Initialize all features
document.addEventListener('DOMContentLoaded', function() {
    calculateReadingTime();
    addShareButtons();
    initDarkMode();
    loadDarkModePreference();
    initLazyLoading();
});

// Performance optimization
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => console.log('SW registered'))
            .catch(registrationError => console.log('SW registration failed'));
    });
}

// Analytics placeholder
function trackEvent(eventName, properties = {}) {
    // Placeholder for analytics tracking
    console.log('Event tracked:', eventName, properties);
}

// Add click tracking to article cards
articleCards.forEach(card => {
    card.addEventListener('click', () => {
        const title = card.querySelector('h3').textContent;
        trackEvent('article_click', { title });
    });
});
