/**
 * Acudhaam Main JavaScript File
 *
 * @package Acudhaam
 * @version 1.0.0
 */

(function($) {
    'use strict';

    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all components
        initTopBarSpacer();
        initCarousel();
        initMobileMenu();
        initSmoothScroll();
        initScrollingBanner();
        initContactForm();
        initBackToTop();
        initLazyLoading();
        initStickySidebar();
        initHeaderOnScroll();
        initMobileDropdowns();
        initSearchToggle();
        initGalleryLightbox();
        initCounterAnimation();
        initParallaxEffect();
        initVideoBackgrounds();
        initBannerEffects();
        initSecondaryBanner();
    });

    // Window load event (for images and heavy assets)
    window.addEventListener('load', function() {
        initPreloader();
        updateTopBarSpacer(); // Ensure spacer is correct after images load
        initBannerImageLoad();
    });

    // Window resize event (debounced)
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            updateTopBarSpacer();
            initStickySidebar();
            initResponsiveBanner();
        }, 250);
    });

    // Window scroll event (throttled)
    let scrollTimer;
    window.addEventListener('scroll', function() {
        if (!scrollTimer) {
            scrollTimer = setTimeout(function() {
                initBackToTop();
                initHeaderOnScroll();
                initParallaxEffect();
                scrollTimer = null;
            }, 100);
        }
    });

    /**
     * ==================================================
     * TOP BAR SPACER FUNCTIONS
     * ==================================================
     */

    /**
     * Initialize top bar spacer on load
     */
    function initTopBarSpacer() {
        updateTopBarSpacer();
    }

    /**
     * Update top bar spacer height based on fixed top bar
     */
    function updateTopBarSpacer() {
        const topBar = document.getElementById('topContactBar');
        const spacer = document.getElementById('headerSpacer');
        const mobileBtn = document.getElementById('mobileMenuBtn');
        
        if (!topBar || !spacer) return;
        
        const headerH = topBar.offsetHeight;
        spacer.style.height = headerH + 'px';
        document.documentElement.style.setProperty('--header-height', headerH + 'px');
        
        if (mobileBtn) {
            mobileBtn.style.top = (headerH + 10) + 'px';
        }
        
        // Adjust anchor scroll positions
        adjustAnchorOffsets(headerH);
    }

    /**
     * Adjust anchor link offsets for fixed header
     */
    function adjustAnchorOffsets(offset) {
        if (window.location.hash) {
            const target = document.querySelector(window.location.hash);
            if (target) {
                setTimeout(function() {
                    const targetPosition = target.getBoundingClientRect().top + window.scrollY;
                    window.scrollTo({
                        top: targetPosition - offset,
                        behavior: 'smooth'
                    });
                }, 100);
            }
        }
    }

    /**
     * ==================================================
     * CAROUSEL FUNCTIONS
     * ==================================================
     */

    /**
     * Initialize hero carousel
     */
    function initCarousel() {
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        const prev = document.getElementById('prevSlide');
        const next = document.getElementById('nextSlide');
        
        if (!slides.length) return;
        
        let current = 0;
        let interval = setInterval(nextSlide, 6000);
        let isTransitioning = false;
        
        /**
         * Update active slide
         */
        function updateSlide(index) {
            if (isTransitioning) return;
            isTransitioning = true;
            
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));
            
            slides[index].classList.add('active');
            dots[index].classList.add('active');
            
            setTimeout(() => {
                isTransitioning = false;
            }, 1500); // Match transition duration
        }
        
        /**
         * Go to next slide
         */
        function nextSlide() { 
            if (!isTransitioning) {
                current = (current + 1) % slides.length; 
                updateSlide(current); 
            }
        }
        
        /**
         * Go to previous slide
         */
        function prevSlide() { 
            if (!isTransitioning) {
                current = (current - 1 + slides.length) % slides.length; 
                updateSlide(current); 
            }
        }
        
        /**
         * Go to specific slide
         */
        function goToSlide(n) { 
            if (!isTransitioning) {
                current = (n + slides.length) % slides.length; 
                updateSlide(current); 
                resetTimer(); 
            }
        }
        
        /**
         * Reset auto-advance timer
         */
        function resetTimer() { 
            clearInterval(interval); 
            interval = setInterval(nextSlide, 6000); 
        }
        
        // Event listeners
        if (prev) {
            prev.addEventListener('click', function() { 
                prevSlide(); 
                resetTimer(); 
            });
        }
        
        if (next) {
            next.addEventListener('click', function() { 
                nextSlide(); 
                resetTimer(); 
            });
        }
        
        // Dot navigation
        dots.forEach((dot, i) => {
            dot.addEventListener('click', function() { 
                goToSlide(i); 
                resetTimer(); 
            });
        });
        
        // Pause on hover
        const carousel = document.querySelector('.fullscreen-carousel');
        if (carousel) {
            carousel.addEventListener('mouseenter', function() {
                clearInterval(interval);
            });
            
            carousel.addEventListener('mouseleave', function() {
                interval = setInterval(nextSlide, 6000);
            });
        }
        
        // Touch support for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        carousel.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        carousel.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                // Swipe left
                nextSlide();
                resetTimer();
            } else if (touchEndX > touchStartX + swipeThreshold) {
                // Swipe right
                prevSlide();
                resetTimer();
            }
        }
        
        // Initialize first slide
        updateSlide(0);
    }

    /**
     * ==================================================
     * MOBILE MENU FUNCTIONS
     * ==================================================
     */

    /**
     * Initialize mobile menu
     */
    function initMobileMenu() {
        const menuBtn = document.getElementById('mobileMenuBtn');
        const overlay = document.getElementById('mobileOverlay');
        const closeBtn = document.getElementById('closeMenu');
        const menuLinks = document.querySelectorAll('.mobile-menu-link');
        
        if (!menuBtn || !overlay || !closeBtn) return;
        
        // Open menu
        menuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openMobileMenu();
        });
        
        // Close menu with close button
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            closeMobileMenu();
        });
        
        // Close menu when clicking a link
        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                closeMobileMenu();
            });
        });
        
        // Close menu with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && overlay.classList.contains('active')) {
                closeMobileMenu();
            }
        });
        
        // Close menu when clicking outside (on overlay background)
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeMobileMenu();
            }
        });
        
        /**
         * Open mobile menu
         */
        function openMobileMenu() {
            overlay.classList.add('active');
            menuBtn.style.display = 'none';
            document.body.style.overflow = 'hidden';
            document.body.style.position = 'fixed';
            document.body.style.width = '100%';
        }
        
        /**
         * Close mobile menu
         */
        function closeMobileMenu() {
            overlay.classList.remove('active');
            menuBtn.style.display = 'flex';
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.width = '';
        }
    }

    /**
     * ==================================================
     * SMOOTH SCROLL FUNCTIONS
     * ==================================================
     */

    /**
     * Initialize smooth scroll for anchor links
     */
    function initSmoothScroll() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
        
        anchorLinks.forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Skip if it's a hash-only link or has no target
                if (href === '#' || !href) return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    
                    // Get top bar height for offset
                    const topBar = document.getElementById('topContactBar');
                    const offset = topBar ? topBar.offsetHeight : 0;
                    
                    // Calculate target position
                    const targetPosition = target.getBoundingClientRect().top + window.scrollY;
                    
                    // Smooth scroll to target
                    window.scrollTo({
                        top: targetPosition - offset,
                        behavior: 'smooth'
                    });
                    
                    // Update URL hash without jumping
                    history.pushState(null, null, href);
                }
            });
        });
    }

    /**
     * ==================================================
     * SCROLLING BANNER FUNCTIONS
     * ==================================================
     */

    /**
     * Initialize scrolling banner
     */
    function initScrollingBanner() {
        const scrollingMsg = document.querySelector('.scrolling-messages');
        
        if (!scrollingMsg) return;
        
        // Pause on hover
        scrollingMsg.addEventListener('mouseenter', function() {
            this.style.animationPlayState = 'paused';
        });
        
        scrollingMsg.addEventListener('mouseleave', function() {
            this.style.animationPlayState = 'running';
        });
        
        // Duplicate content for seamless scrolling if needed
        ensureSeamlessScroll(scrollingMsg);
    }

    /**
     * Ensure seamless scrolling by cloning content if needed
     */
    function ensureSeamlessScroll(container) {
        const items = container.children;
        if (items.length < 8) { // If not enough items for smooth loop
            const clone = container.innerHTML;
            container.innerHTML = clone + clone;
        }
    }

    /**
     * ==================================================
     * CONTACT FORM FUNCTIONS
     * ==================================================
     */

    /**
     * Initialize contact form with AJAX submission
     */
    function initContactForm() {
        const contactForm = document.getElementById('contactForm');
        
        if (!contactForm) return;
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formResponse = document.getElementById('formResponse');
            const submitBtn = document.getElementById('contactSubmit');
            const originalText = submitBtn ? submitBtn.textContent : 'Send Message';
            
            // Show loading state
            if (submitBtn) {
                submitBtn.textContent = 'Sending...';
                submitBtn.disabled = true;
            }
            
            // Collect form data
            const formData = new FormData(contactForm);
            formData.append('action', 'acudhaam_contact');
            
            // Add nonce if available
            if (typeof acudhaam_ajax !== 'undefined') {
                formData.append('nonce', acudhaam_ajax.nonce);
            }
            
            // Send AJAX request
            fetch(acudhaam_ajax.ajax_url, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Success message
                    if (formResponse) {
                        formResponse.innerHTML = '<p style="color: #d4af37; background: rgba(212,175,55,0.1); padding: 15px; border-radius: 10px;">' + data.data + '</p>';
                        formResponse.style.display = 'block';
                    }
                    contactForm.reset();
                } else {
                    // Error message
                    if (formResponse) {
                        formResponse.innerHTML = '<p style="color: #ff6b6b; background: rgba(255,107,107,0.1); padding: 15px; border-radius: 10px;">' + data.data + '</p>';
                        formResponse.style.display = 'block';
                    }
                }
                
                // Auto-hide message after 5 seconds
                setTimeout(() => {
                    if (formResponse) {
                        formResponse.style.display = 'none';
                    }
                }, 5000);
            })
            .catch(error => {
                console.error('Error:', error);
                if (formResponse) {
                    formResponse.innerHTML = '<p style="color: #ff6b6b;">Network error. Please try again.</p>';
                    formResponse.style.display = 'block';
                }
            })
            .finally(() => {
                // Reset button state
                if (submitBtn) {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }
            });
        });
    }

    /**
     * ==================================================
     * BACK TO TOP BUTTON
     * ==================================================
     */

    /**
     * Initialize back to top button
     */
    function initBackToTop() {
        // Create button if it doesn't exist
        let backToTop = document.querySelector('.back-to-top');
        
        if (!backToTop) {
            backToTop = document.createElement('button');
            backToTop.className = 'back-to-top';
            backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
            backToTop.setAttribute('aria-label', 'Back to top');
            document.body.appendChild(backToTop);
            
            // Add click event
            backToTop.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
        
        // Show/hide based on scroll position
        const scrollPosition = window.scrollY;
        const windowHeight = window.innerHeight;
        
        if (scrollPosition > windowHeight) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    }

    /**
     * ==================================================
     * LAZY LOADING
     * ==================================================
     */

    /**
     * Initialize lazy loading for images
     */
    function initLazyLoading() {
        // Check if IntersectionObserver is supported
        if ('IntersectionObserver' in window) {
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        // Already loaded by browser's native lazy loading
                        observer.unobserve(img);
                    }
                });
            });
            
            lazyImages.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

    /**
     * ==================================================
     * STICKY SIDEBAR
     * ==================================================
     */

    /**
     * Initialize sticky sidebar
     */
    function initStickySidebar() {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.blog-main');
        
        if (!sidebar || !mainContent || window.innerWidth < 992) {
            return;
        }
        
        // Reset any inline styles
        sidebar.style.position = '';
        sidebar.style.top = '';
        
        // Make sure sidebar doesn't exceed viewport height
        const topBar = document.getElementById('topContactBar');
        const offset = topBar ? topBar.offsetHeight : 0;
        
        sidebar.style.maxHeight = 'calc(100vh - ' + (offset + 30) + 'px)';
    }

    /**
     * ==================================================
     * HEADER ON SCROLL
     * ==================================================
     */

    /**
     * Initialize header transformations on scroll
     */
    function initHeaderOnScroll() {
        const topBar = document.getElementById('topContactBar');
        const scrollPosition = window.scrollY;
        
        if (!topBar) return;
        
        if (scrollPosition > 100) {
            topBar.classList.add('scrolled');
        } else {
            topBar.classList.remove('scrolled');
        }
    }

    /**
     * ==================================================
     * MOBILE DROPDOWNS
     * ==================================================
     */

    /**
     * Initialize mobile dropdown menus
     */
    function initMobileDropdowns() {
        const dropdownParents = document.querySelectorAll('.menu-item-has-children');
        
        if (window.innerWidth <= 768) {
            dropdownParents.forEach(function(item) {
                const link = item.querySelector('a');
                const submenu = item.querySelector('.sub-menu');
                
                if (link && submenu) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        item.classList.toggle('active');
                        
                        // Toggle submenu with animation
                        if (item.classList.contains('active')) {
                            submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        } else {
                            submenu.style.maxHeight = '0';
                        }
                    });
                }
            });
        }
    }

    /**
     * ==================================================
     * SEARCH TOGGLE
     * ==================================================
     */

    /**
     * Initialize search toggle button
     */
    function initSearchToggle() {
        const searchToggle = document.querySelector('.search-toggle');
        const searchForm = document.querySelector('.header-search-form');
        
        if (!searchToggle || !searchForm) return;
        
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            searchForm.classList.toggle('active');
            
            if (searchForm.classList.contains('active')) {
                searchForm.querySelector('input[type="search"]').focus();
            }
        });
        
        // Close on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchForm.classList.contains('active')) {
                searchForm.classList.remove('active');
            }
        });
    }

    /**
     * ==================================================
     * GALLERY LIGHTBOX
     * ==================================================
     */

    /**
     * Initialize lightbox for galleries
     */
    function initGalleryLightbox() {
        const galleryImages = document.querySelectorAll('.wp-block-gallery figure a, .gallery-icon a');
        
        galleryImages.forEach(function(link) {
            link.addEventListener('click', function(e) {
                // This is a placeholder for lightbox functionality
                // You can integrate with a lightbox library like PhotoSwipe or Fancybox
                e.preventDefault();
                console.log('Lightbox would open:', this.href);
            });
        });
    }

    /**
     * ==================================================
     * COUNTER ANIMATION
     * ==================================================
     */

    /**
     * Initialize counter animations
     */
    function initCounterAnimation() {
        const counters = document.querySelectorAll('.stat-number');
        
        if (!counters.length) return;
        
        // Check if element is in viewport
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }
        
        // Animate counter
        function animateCounter(element) {
            const target = parseInt(element.innerText.replace(/[^0-9]/g, ''));
            const suffix = element.innerText.replace(/[0-9]/g, '');
            let current = 0;
            const increment = target / 50; // Animate over 50 steps
            
            function updateCounter() {
                current += increment;
                if (current < target) {
                    element.innerText = Math.floor(current) + suffix;
                    requestAnimationFrame(updateCounter);
                } else {
                    element.innerText = target + suffix;
                }
            }
            
            requestAnimationFrame(updateCounter);
        }
        
        // Check on scroll
        window.addEventListener('scroll', function() {
            counters.forEach(function(counter) {
                if (isElementInViewport(counter) && !counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    animateCounter(counter);
                }
            });
        }, { passive: true });
        
        // Check on load
        counters.forEach(function(counter) {
            if (isElementInViewport(counter) && !counter.classList.contains('animated')) {
                counter.classList.add('animated');
                animateCounter(counter);
            }
        });
    }

    /**
     * ==================================================
     * PARALLAX EFFECT
     * ==================================================
     */

    /**
     * Initialize parallax effect on hero background
     */
    function initParallaxEffect() {
        const hero = document.querySelector('.fullscreen-carousel');
        
        if (!hero || window.innerWidth < 768) return;
        
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            const opacity = 1 - (scrollPosition / (hero.offsetHeight * 0.5));
            
            if (opacity > 0) {
                hero.style.opacity = opacity;
            }
            
            // Parallax effect for background
            const slides = document.querySelectorAll('.carousel-slide.active');
            slides.forEach(function(slide) {
                const speed = 0.5;
                const yPos = -(scrollPosition * speed / 100);
                slide.style.transform = 'translateY(' + yPos + 'px)';
            });
        }, { passive: true });
    }

    /**
     * ==================================================
     * VIDEO BACKGROUNDS
     * ==================================================
     */

    /**
     * Initialize video backgrounds
     */
    function initVideoBackgrounds() {
        const videoWrappers = document.querySelectorAll('.video-background');
        
        videoWrappers.forEach(function(wrapper) {
            const video = wrapper.querySelector('video');
            
            if (video) {
                video.play().catch(function(error) {
                    console.log('Autoplay prevented:', error);
                });
                
                // Pause video when not in viewport to save resources
                if ('IntersectionObserver' in window) {
                    const observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) {
                                video.play();
                            } else {
                                video.pause();
                            }
                        });
                    });
                    
                    observer.observe(wrapper);
                }
            }
        });
    }

    /**
     * ==================================================
     * BANNER EFFECTS
     * ==================================================
     */

    /**
     * Initialize banner effects
     */
    function initBannerEffects() {
        const banner = document.querySelector('.clinic-banner');
        
        if (!banner) return;
        
        // Add fade-in effect
        banner.style.opacity = '0';
        banner.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
            banner.style.opacity = '1';
        }, 100);
        
        // Add hover effect for image banners
        if (banner.classList.contains('image-banner')) {
            banner.addEventListener('mouseenter', function() {
                this.style.backgroundSize = '105%';
            });
            
            banner.addEventListener('mouseleave', function() {
                this.style.backgroundSize = 'cover';
            });
        }
    }

    /**
     * Initialize banner after image loads
     */
    function initBannerImageLoad() {
        const banner = document.querySelector('.clinic-banner.image-banner');
        
        if (!banner) return;
        
        const bgImage = window.getComputedStyle(banner).backgroundImage;
        if (bgImage !== 'none') {
            const imgUrl = bgImage.replace(/url\((['"])?(.*?)\1\)/gi, '$2');
            const img = new Image();
            img.src = imgUrl;
            img.onload = function() {
                banner.classList.add('banner-image-loaded');
            };
        }
    }

    /**
     * Initialize responsive banner
     */
    function initResponsiveBanner() {
        const banner = document.querySelector('.clinic-banner');
        
        if (!banner) return;
        
        if (window.innerWidth <= 768) {
            banner.classList.add('banner-mobile');
        } else {
            banner.classList.remove('banner-mobile');
        }
    }

    /**
     * ==================================================
     * SECONDARY BANNER
     * ==================================================
     */

    /**
     * Initialize secondary banner
     */
    function initSecondaryBanner() {
        const secondaryBanner = document.querySelector('.secondary-banner');
        
        if (!secondaryBanner) return;
        
        // Add close button if needed
        if (!secondaryBanner.querySelector('.banner-close')) {
            const closeBtn = document.createElement('button');
            closeBtn.className = 'banner-close';
            closeBtn.innerHTML = '<i class="fas fa-times"></i>';
            closeBtn.setAttribute('aria-label', 'Close banner');
            
            closeBtn.addEventListener('click', function() {
                secondaryBanner.style.display = 'none';
                // Save preference in localStorage
                localStorage.setItem('secondaryBannerClosed', 'true');
            });
            
            secondaryBanner.appendChild(closeBtn);
        }
        
        // Check if banner was previously closed
        if (localStorage.getItem('secondaryBannerClosed') === 'true') {
            secondaryBanner.style.display = 'none';
        }
    }

    /**
     * ==================================================
     * PRELOADER
     * ==================================================
     */

    /**
     * Initialize preloader
     */
    function initPreloader() {
        const preloader = document.querySelector('.preloader');
        
        if (preloader) {
            setTimeout(function() {
                preloader.classList.add('fade-out');
                
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }, 500);
        }
    }

    /**
     * ==================================================
     * ADDITIONAL UTILITIES
     * ==================================================
     */

    /**
     * Debounce function for performance
     */
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

    /**
     * Throttle function for performance
     */
    function throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }

    /**
     * Add CSS class for touch devices
     */
    function detectTouchDevice() {
        if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
            document.body.classList.add('touch-device');
        } else {
            document.body.classList.add('no-touch-device');
        }
    }
    detectTouchDevice();

    /**
     * Add CSS classes for browser detection
     */
    function detectBrowser() {
        const ua = navigator.userAgent;
        if (ua.indexOf('Safari') !== -1 && ua.indexOf('Chrome') === -1) {
            document.body.classList.add('safari');
        }
        if (ua.indexOf('Firefox') !== -1) {
            document.body.classList.add('firefox');
        }
    }
    detectBrowser();

})(jQuery);

/**
 * ==================================================
 * CUSTOMIZER LIVE PREVIEW
 * ==================================================
 * This runs only in Customizer preview window
 */
if (typeof wp !== 'undefined' && wp.customize) {
    
    // Clinic Banner Enable/Disable
    wp.customize('clinic_banner_enabled', function(value) {
        value.bind(function(newval) {
            const banner = document.querySelector('.clinic-banner');
            if (banner) {
                if (newval) {
                    banner.style.display = 'block';
                } else {
                    banner.style.display = 'none';
                }
            }
        });
    });
    
    // Banner Title
    wp.customize('clinic_banner_title', function(value) {
        value.bind(function(newval) {
            document.querySelectorAll('.clinic-title').forEach(function(el) {
                el.textContent = newval;
            });
        });
    });
    
    // Banner Tamil Subtitle
    wp.customize('clinic_banner_subtitle_tamil', function(value) {
        value.bind(function(newval) {
            document.querySelectorAll('.clinic-address-tamil').forEach(function(el) {
                el.textContent = newval;
            });
        });
    });
    
    // Banner Address
    wp.customize('clinic_banner_address', function(value) {
        value.bind(function(newval) {
            document.querySelectorAll('.clinic-address').forEach(function(el) {
                el.textContent = newval;
            });
        });
    });
    
    // Banner Type
    wp.customize('clinic_banner_type', function(value) {
        value.bind(function(newval) {
            const banner = document.querySelector('.clinic-banner');
            if (banner) {
                if (newval === 'image') {
                    banner.classList.add('image-banner');
                } else {
                    banner.classList.remove('image-banner');
                }
            }
        });
    });
    
    // Banner Image
    wp.customize('clinic_banner_image', function(value) {
        value.bind(function(newval) {
            const banner = document.querySelector('.clinic-banner');
            if (banner && newval) {
                banner.style.backgroundImage = 'url(' + newval + ')';
            }
        });
    });
    
    // Banner Background Color
    wp.customize('clinic_banner_bg_color', function(value) {
        value.bind(function(newval) {
            const banner = document.querySelector('.clinic-banner');
            if (banner) {
                banner.style.background = newval;
            }
        });
    });
    
    // Banner Text Color
    wp.customize('clinic_banner_text_color', function(value) {
        value.bind(function(newval) {
            document.querySelectorAll('.clinic-address-tamil, .clinic-address').forEach(function(el) {
                el.style.color = newval;
            });
        });
    });
    
    // Banner Title Color
    wp.customize('clinic_banner_title_color', function(value) {
        value.bind(function(newval) {
            document.querySelectorAll('.clinic-title').forEach(function(el) {
                el.style.color = newval;
            });
        });
    });
    
    // Banner Button Enable/Disable
    wp.customize('clinic_banner_button_enabled', function(value) {
        value.bind(function(newval) {
            const bannerBtn = document.querySelector('.banner-button');
            if (bannerBtn) {
                if (newval) {
                    bannerBtn.style.display = 'block';
                } else {
                    bannerBtn.style.display = 'none';
                }
            }
        });
    });
    
    // Banner Button Text
    wp.customize('clinic_banner_button_text', function(value) {
        value.bind(function(newval) {
            const btn = document.querySelector('.banner-button .btn');
            if (btn) {
                btn.textContent = newval;
            }
        });
    });
    
    // Banner Button URL
    wp.customize('clinic_banner_button_url', function(value) {
        value.bind(function(newval) {
            const btn = document.querySelector('.banner-button .btn');
            if (btn) {
                btn.href = newval;
            }
        });
    });
    
    // Banner Button Color
    wp.customize('clinic_banner_button_color', function(value) {
        value.bind(function(newval) {
            const btn = document.querySelector('.banner-button .btn');
            if (btn) {
                btn.style.color = newval;
            }
        });
    });
    
    // Banner Button Border Color
    wp.customize('clinic_banner_button_border_color', function(value) {
        value.bind(function(newval) {
            const btn = document.querySelector('.banner-button .btn');
            if (btn) {
                btn.style.borderColor = newval;
            }
        });
    });
    
    // Secondary Banner
    wp.customize('secondary_banner_enabled', function(value) {
        value.bind(function(newval) {
            const secondaryBanner = document.querySelector('.secondary-banner');
            if (secondaryBanner) {
                if (newval) {
                    secondaryBanner.style.display = 'block';
                } else {
                    secondaryBanner.style.display = 'none';
                }
            }
        });
    });
    
    wp.customize('secondary_banner_text', function(value) {
        value.bind(function(newval) {
            const textEl = document.querySelector('.secondary-banner-text');
            if (textEl) {
                textEl.textContent = newval;
            }
        });
    });
    
    wp.customize('secondary_banner_link', function(value) {
        value.bind(function(newval) {
            const linkEl = document.querySelector('.secondary-banner-link');
            if (linkEl) {
                linkEl.href = newval;
            }
        });
    });
    
    wp.customize('secondary_banner_bg_color', function(value) {
        value.bind(function(newval) {
            const banner = document.querySelector('.secondary-banner');
            if (banner) {
                banner.style.backgroundColor = newval;
            }
        });
    });
}