import Alpine from 'alpinejs';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

// Accessibility font zoom handler
Alpine.data('fontScaler', () => ({
    zoomLevel: 100,
    increase() {
        if (this.zoomLevel < 125) {
            this.zoomLevel += 5;
            document.documentElement.style.fontSize = `${this.zoomLevel}%`;
        }
    },
    decrease() {
        if (this.zoomLevel > 90) {
            this.zoomLevel -= 5;
            document.documentElement.style.fontSize = `${this.zoomLevel}%`;
        }
    },
    reset() {
        this.zoomLevel = 100;
        document.documentElement.style.fontSize = '100%';
    }
}));

// Hero Slider Alpine component
Alpine.data('heroSlider', () => ({
    activeSlide: 0,
    totalSlides: 2,
    timer: null,
    init() {
        this.startAutoplay();
    },
    next() {
        this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
        this.resetAutoplay();
    },
    prev() {
        this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides;
        this.resetAutoplay();
    },
    goTo(index) {
        this.activeSlide = index;
        this.resetAutoplay();
    },
    startAutoplay() {
        this.timer = setInterval(() => {
            this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
        }, 7000);
    },
    resetAutoplay() {
        clearInterval(this.timer);
        this.startAutoplay();
    }
}));

// Customer segment tabs
Alpine.data('enquiryTabs', () => ({
    activeTab: 'residential',
    setTab(tab) {
        this.activeTab = tab;
    }
}));

// FAQ Accordion
Alpine.data('faqAccordion', () => ({
    activeItem: null,
    toggle(id) {
        this.activeItem = this.activeItem === id ? null : id;
    }
}));

Alpine.start();

// Initialize GSAP Scroll Animations once DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // 1. Scroll-triggered reveal animations for sections & cards
    const fadeUpElements = document.querySelectorAll('.gsap-fade-up');
    fadeUpElements.forEach((el) => {
        gsap.fromTo(el, 
            { 
                opacity: 0, 
                y: 35 
            }, 
            {
                opacity: 1, 
                y: 0, 
                duration: 0.85, 
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    toggleActions: 'play none none none'
                }
            }
        );
    });

    // 2. Staggered card reveals
    const staggerContainers = document.querySelectorAll('.gsap-stagger-container');
    staggerContainers.forEach((container) => {
        const items = container.querySelectorAll('.gsap-stagger-item');
        if (items.length > 0) {
            gsap.fromTo(items, 
                { opacity: 0, y: 30 }, 
                {
                    opacity: 1, 
                    y: 0, 
                    duration: 0.75, 
                    stagger: 0.14, 
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: container,
                        start: 'top 85%',
                        toggleActions: 'play none none none'
                    }
                }
            );
        }
    });

    // 3. Number Counter Animation for Key Targets
    const counterElements = document.querySelectorAll('.stat-counter');
    counterElements.forEach((counter) => {
        const targetValue = parseInt(counter.getAttribute('data-target'), 10);
        if (!isNaN(targetValue)) {
            const obj = { val: 0 };
            gsap.to(obj, {
                val: targetValue,
                duration: 2.2,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: counter,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                },
                onUpdate: () => {
                    counter.innerText = Math.floor(obj.val).toLocaleString();
                }
            });
        }
    });

    // 4. Parallax effect for Pipeline & scenic backgrounds
    const parallaxBgs = document.querySelectorAll('.parallax-bg');
    parallaxBgs.forEach((bg) => {
        gsap.to(bg, {
            yPercent: 15,
            ease: 'none',
            scrollTrigger: {
                trigger: bg.parentElement,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true
            }
        });
    });

    // 5. SVG Pipeline Draw on scroll
    const pipelineSvg = document.querySelector('.pipeline-path-animated');
    if (pipelineSvg) {
        const pathLength = pipelineSvg.getTotalLength ? pipelineSvg.getTotalLength() : 1200;
        gsap.set(pipelineSvg, { strokeDasharray: pathLength, strokeDashoffset: pathLength });
        gsap.to(pipelineSvg, {
            strokeDashoffset: 0,
            duration: 2.5,
            ease: 'power2.inOut',
            scrollTrigger: {
                trigger: pipelineSvg,
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    }
});
