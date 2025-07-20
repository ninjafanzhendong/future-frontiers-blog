/**
 * Future Frontiers HQ Theme JavaScript
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initMobileMenu();
        initScrollAnimations();
        initNewsletterForm();
        initLazyLoading();
    });

    // Mobile menu toggle
    function initMobileMenu() {
        $('.menu-toggle').on('click', function() {
            const $menu = $('#primary-menu');
            const isExpanded = $(this).attr('aria-expanded') === 'true';
            
            $(this).attr('aria-expanded', !isExpanded);
            $menu.toggleClass('hidden');
        });
    }

    // Scroll animations
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    $(entry.target).addClass('fade-in');
                }
            });
        }, observerOptions);

        $('.post-card').each(function() {
            observer.observe(this);
        });
    }

    // Newsletter form
    function initNewsletterForm() {
        $('form[action*="newsletter"]').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $email = $form.find('input[type="email"]');
            const $button = $form.find('button[type="submit"]');
            const originalText = $button.text();
            
            if (!validateEmail($email.val())) {
                showNotification('Please enter a valid email address', 'error');
                return;
            }
            
            $button.text('Subscribing...').prop('disabled', true);
            
            $.ajax({
                url: ffhq_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'newsletter_subscribe',
                    email: $email.val(),
                    nonce: ffhq_ajax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        showNotification(response.data.message, 'success');
                        $email.val('');
                    } else {
                        showNotification(response.data.message, 'error');
                    }
                },
                error: function() {
                    showNotification('An error occurred. Please try again.', 'error');
                },
                complete: function() {
                    $button.text(originalText).prop('disabled', false);
                }
            });
        });
    }

    // Email validation
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Show notification
    function showNotification(message, type) {
        const $notification = $('<div class="notification fixed top-4 right-4 p-4 rounded-lg text-white font-semibold z-50 transform translate-x-full transition-transform duration-300"></div>')
            .addClass(type === 'success' ? 'bg-green-500' : 'bg-red-500')
            .text(message);
        
        $('body').append($notification);
        
        setTimeout(function() {
            $notification.removeClass('translate-x-full');
        }, 100);
        
        setTimeout(function() {
            $notification.addClass('translate-x-full');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 3000);
    }

    // Lazy loading for images
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            $('img[data-src]').each(function() {
                imageObserver.observe(this);
            });
        }
    }

    // Smooth scroll for anchor links
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 1000);
        }
    });

    // Reading time calculation
    function calculateReadingTime() {
        $('.post-content').each(function() {
            const $content = $(this);
            const text = $content.text();
            const wordCount = text.split(/\s+/).length;
            const readingTime = Math.ceil(wordCount / 200);
            
            const $readingTime = $('<span class="reading-time text-sm text-gray-500 ml-2"></span>')
                .text(readingTime + ' min read');
            
            $content.find('.post-meta').append($readingTime);
        });
    }

    // Initialize reading time on single posts
    if ($('body').hasClass('single')) {
        calculateReadingTime();
    }

    // Search functionality
    $('.search-form').on('submit', function(e) {
        e.preventDefault();
        const query = $(this).find('.search-field').val();
        if (query) {
            window.location.href = $(this).attr('action') + '?s=' + encodeURIComponent(query);
        }
    });

    // Back to top button
    const $backToTop = $('<button class="back-to-top fixed bottom-4 right-4 w-12 h-12 bg-gradient-to-r from-[#00D4FF] to-[#FF006E] text-white rounded-full shadow-lg opacity-0 transition-opacity duration-300 z-50">↑</button>');
    $('body').append($backToTop);

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $backToTop.removeClass('opacity-0');
        } else {
            $backToTop.addClass('opacity-0');
        }
    });

    $backToTop.on('click', function() {
        $('html, body').animate({ scrollTop: 0 }, 800);
    });

})(jQuery);
