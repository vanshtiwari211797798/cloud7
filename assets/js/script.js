
        // DOM Elements
        const preloader = document.getElementById('preloader');
        const searchToggle = document.getElementById('search-toggle');
        const searchBar = document.getElementById('search-bar');
        const menuToggle = document.getElementById('menu-toggle');
        const mobileNavOverlay = document.getElementById('mobile-nav-overlay');
        const mobileNav = document.getElementById('mobile-nav');
        const mobileNavClose = document.getElementById('mobile-nav-close');
        const shopDropdownToggle = document.getElementById('shop-dropdown-toggle');
        const shopDropdown = document.getElementById('shop-dropdown');
        const userIcon = document.getElementById('user-icon');
        const wishlistIcon = document.getElementById('wishlist-icon');
        const profileMenuItem = document.getElementById('profile-menu-item');
        const loginLink = document.getElementById('login-link');
        const loginText = document.getElementById('login-text');

        // Check if user is logged in
        function checkLoginStatus() {
            // Replace with your actual login check logic
            // For example, check a session cookie or localStorage
            const isLoggedIn = localStorage.getItem('user_id') !== null;

            if (isLoggedIn) {
                // Update UI for logged in user
                if (userIcon) userIcon.style.display = 'none';
                if (wishlistIcon) wishlistIcon.style.display = 'none';
                if (profileMenuItem) profileMenuItem.style.display = 'block';
                if (loginLink) loginLink.href = 'includes/authentication/logout.php';
                if (loginText) loginText.textContent = 'Log out';
            } else {
                // Update UI for logged out user
                if (userIcon) userIcon.style.display = 'flex';
                if (wishlistIcon) wishlistIcon.style.display = 'flex';
                if (profileMenuItem) profileMenuItem.style.display = 'none';
                if (loginLink) loginLink.href = 'includes/authentication/login.php';
                if (loginText) loginText.textContent = 'Log in';
            }
        }

        // Hide preloader when content is loaded
        function hidePreloader() {
            if (preloader) {
                preloader.style.display = 'none';
            }
        }

        // Toggle search bar visibility
        function toggleSearch() {
            searchBar.classList.toggle('visible');
        }

        // Open mobile menu
        function openMobileMenu() {
            mobileNavOverlay.classList.add('visible');
            mobileNav.classList.add('visible');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        // Close mobile menu
        function closeMobileMenu() {
            mobileNavOverlay.classList.remove('visible');
            mobileNav.classList.remove('visible');
            document.body.style.overflow = ''; // Restore scrolling
        }

        // Toggle shop dropdown
        function toggleShopDropdown() {
            shopDropdown.classList.toggle('visible');
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            checkLoginStatus();

            // Use event-based loading instead of timeout
            if (document.readyState === 'complete') {
                hidePreloader();
            } else {
                window.addEventListener('load', hidePreloader);
            }

            // Set a fallback timeout to ensure preloader is hidden
            setTimeout(hidePreloader, 5000);
        });

        // Search toggle
        if (searchToggle) {
            searchToggle.addEventListener('click', toggleSearch);
        }

        // Mobile menu toggle
        if (menuToggle) {
            menuToggle.addEventListener('click', openMobileMenu);
        }

        // Mobile menu close
        if (mobileNavClose) {
            mobileNavClose.addEventListener('click', closeMobileMenu);
        }

        // Close mobile menu when clicking outside
        if (mobileNavOverlay) {
            mobileNavOverlay.addEventListener('click', function(event) {
                if (event.target === mobileNavOverlay) {
                    closeMobileMenu();
                }
            });
        }

        // Shop dropdown toggle
        if (shopDropdownToggle) {
            shopDropdownToggle.addEventListener('click', toggleShopDropdown);
        }

        // Close dropdown when clicking elsewhere
        document.addEventListener('click', function(event) {
            if (!shopDropdownToggle.contains(event.target) && !shopDropdown.contains(event.target)) {
                shopDropdown.classList.remove('visible');
            }
        });

        // Escape key closes modals
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                searchBar.classList.remove('visible');
                closeMobileMenu();
            }
        });

// hero section start 
let flag = 0;

function controller(x) {
    flag += x;
    slideshow(flag);
}

function slideshow(num) {
    let slides = document.getElementsByClassName("slide");

    if (num >= slides.length) {
        flag = 0;
    }

    if (num < 0) {
        flag = slides.length - 1;
    }

    for (let y of slides) {
        y.style.display = "none";
    }

    slides[flag].style.display = "block";
}

// Call slideshow initially
slideshow(flag);

// Auto-slide every 3 seconds
setInterval(() => {
    flag++;
    slideshow(flag);
}, 3000);




// best sller cards 

gsap.registerPlugin(ScrollTrigger);
gsap.utils.toArray(".product-card").forEach((card) => {
    gsap.to(card, {
        opacity: 1,
        y: 0,
        duration: 1,
        ease: "power2.out",
        scrollTrigger: {
            trigger: card,
            start: "top 80%",
            toggleActions: "play none none none"
        }
    });
});





// row video 

// Select all video elements with the class 'productVideo'
const videos = document.querySelectorAll('.productVideo');

// Add a click event listener to each video
videos.forEach(video => {
    video.addEventListener('click', function() {
        if (this.requestFullscreen) {
            this.requestFullscreen();
        } else if (this.mozRequestFullScreen) { // Firefox
            this.mozRequestFullScreen();
        } else if (this.webkitRequestFullscreen) { // Chrome, Safari and Opera
            this.webkitRequestFullscreen();
        } else if (this.msRequestFullscreen) { // IE/Edge
            this.msRequestFullscreen();
        }
    });
});