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
    totalSlides: 3,
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
        }, 3000);
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

    const mainNav = document.querySelector('nav');
    const getNavHeight = () => (mainNav ? mainNav.offsetHeight : 65);

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 1: Hero Slider — Step-wise scroll shrink from bottom
    // Photo 1: Full-height hero with natural aspect ratio (2141:928)
    // Photo 2: As you scroll, height shrinks smoothly from bottom up
    // Photo 3: Shrinks into sleek ribbon (~140px) as #about arrives
    // Fully responsive across all devices (desktop, 1024px, tablet, mobile)
    // ─────────────────────────────────────────────────────────────
    const heroShrink = document.getElementById('hero-shrink-container');
    const heroWrap = document.getElementById('hero-section-wrap');
    if (heroShrink && heroWrap) {
        const getMinHeight = () => {
            if (window.innerWidth >= 1024) return 140;
            if (window.innerWidth >= 768) return 110;
            return 80;
        };

        // Dynamically compute natural rendered height based on current width (2141:928 ratio)
        // This ensures the image is never squeezed or vertically stretched to crop horizontal text
        const getNaturalHeight = () => {
            const currentW = heroShrink.offsetWidth || heroWrap.offsetWidth || 1200;
            return Math.round(currentW * (928 / 2141));
        };

        const getShrinkDelta = () => Math.max(60, getNaturalHeight() - getMinHeight());

        gsap.fromTo(heroShrink,
            { height: () => getNaturalHeight() },
            {
                height: getMinHeight,
                ease: 'none',
                scrollTrigger: {
                    trigger: heroWrap,
                    start: () => `top top+=${getNavHeight()}`, // locks top gap under sticky navbar
                    end: () => `+=${getShrinkDelta()}`,        // scroll distance exactly matches height reduction
                    scrub: 1.0,
                    pin: true,
                    pinSpacing: false,
                    invalidateOnRefresh: true
                }
            }
        );
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 2: JV Partners (#about) — Parallax on scroll from Hero
    // Left gas station card and right text column move at different
    // speeds linked directly to the scrollbar (scrub), creating real depth.
    // ─────────────────────────────────────────────────────────────
    const jvSection = document.getElementById('about');
    const jvLeft = document.querySelector('.jv-anim-left');
    const jvRight = document.querySelector('.jv-anim-right');
    const jvStationImg = document.querySelector('.jv-station-img');

    if (jvSection) {
        // Left column card parallax float (solid 100% opacity, crisp & clear)
        if (jvLeft) {
            gsap.fromTo(jvLeft,
                { y: 60 },
                {
                    y: -25,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: jvSection,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1.2
                    }
                }
            );
        }

        // Inner Gas Station image subtle parallax drift inside its rounded card
        if (jvStationImg) {
            gsap.fromTo(jvStationImg,
                { yPercent: -8, scale: 1.08 },
                {
                    yPercent: 8,
                    scale: 1.0,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: jvSection,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1.5
                    }
                }
            );
        }

        // Right column typography parallax float (solid 100% opacity, crisp & clear)
        if (jvRight) {
            gsap.fromTo(jvRight,
                { y: 35 },
                {
                    y: -15,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: jvSection,
                        start: 'top bottom',
                        end: 'bottom top',
                        scrub: 1.0
                    }
                }
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 3: News, Events & Notices (#joint-venture) Multi-Layer Bottom-to-Top Parallax
    // As user scrolls from #about into #joint-venture:
    // • Background landscape drifts smoothly (y: 70 -> -25) with deep atmospheric parallax
    // • Left "A 50:50 Joint Venture" column rises from bottom (y: 160 -> 0)
    // • Right "News, Events and Notices" column rises from deeper bottom (y: 230 -> 0)
    // • The two columns and background travel at different speeds for genuine 3D parallax depth
    // ─────────────────────────────────────────────────────────────
    const newsSection = document.getElementById('joint-venture');
    const newsBg = document.querySelector('.news-bg-parallax');
    const newsContent = document.querySelector('.news-content-parallax');
    const jvCards = document.querySelector('.jv-cards-parallax');

    if (newsSection) {
        // 0. The WHOLE SECTION comes from bottom to top, settling faster into current position
        gsap.fromTo(newsSection,
            { y: 130, scale: 0.80, transformOrigin: 'center bottom' },
            {
                y: 0,
                scale: 1.0,
                ease: 'power1.out',
                scrollTrigger: {
                    trigger: newsSection,
                    start: 'top bottom',
                    end: 'top 45%', // Completes earlier so it settles into position faster
                    scrub: 0.7,     // Quicker, more responsive scrub
                    invalidateOnRefresh: true
                }
            }
        );

        // 1. Background image vertical scroll travel from top mountains/monastery (Image 2) to bottom wave ribbon (Image 3)
        if (newsBg) {
            gsap.fromTo(newsBg,
                { y: 0 },
                {
                    y: () => -(newsBg.offsetHeight - newsSection.offsetHeight),
                    ease: 'none',
                    scrollTrigger: {
                        trigger: newsSection,
                        start: 'top 70%',
                        end: 'bottom 20%',
                        scrub: 1.0,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        // 2. Left column (A 50:50 Joint Venture & Partner Cards) rises from bottom
        if (jvCards) {
            gsap.fromTo(jvCards,
                { y: 70 },
                {
                    y: 0,
                    ease: 'power1.out',
                    scrollTrigger: {
                        trigger: newsSection,
                        start: 'top bottom',
                        end: 'top 45%',
                        scrub: 0.6,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        // 3. Right column ("News, Events and Notices" Card) rises from deeper bottom
        if (newsContent) {
            gsap.fromTo(newsContent,
                { y: 100 },
                {
                    y: 0,
                    ease: 'power1.out',
                    scrollTrigger: {
                        trigger: newsSection,
                        start: 'top bottom',
                        end: 'top 45%',
                        scrub: 0.5,
                        invalidateOnRefresh: true
                    }
                }
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 4: Our Key Development Targets (#development-targets)
    // As user scrolls from #joint-venture into #development-targets:
    // • Card starts shrunk from center (scale: 0.91) and smoothly
    //   expands outward to fit its 100% current position/size.
    // • Content overlay floats in with subtle parallax depth.
    // ─────────────────────────────────────────────────────────────
    const targetsSection = document.getElementById('development-targets');
    const targetsCard = document.getElementById('targets-card');
    const targetsContent = document.querySelector('.targets-content-parallax');

    if (targetsSection && targetsCard) {
        // Expand from center: scale 0.70 -> 1.0 from center center
        gsap.fromTo(targetsCard,
            { scale: 0.70, transformOrigin: 'center center' },
            {
                scale: 1.0,
                ease: 'none',
                scrollTrigger: {
                    trigger: targetsSection,
                    start: 'top bottom',
                    end: 'top 20%',
                    scrub: 1.2
                }
            }
        );

        // Content overlay subtle parallax float
        if (targetsContent) {
            gsap.fromTo(targetsContent,
                { y: 40 },
                {
                    y: 0,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: targetsSection,
                        start: 'top bottom',
                        end: 'top 25%',
                        scrub: 1.0
                    }
                }
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 5: Parallax Sheet Overlap into "Explore Our Services"
    // Photo 1 -> Photo 2 -> Photo 3:
    // As user scrolls from #development-targets into #services-interactive:
    // • #development-targets pins in place below the navbar
    // • #services-interactive (z-30, bg-[#f4f9f5]) smoothly slides UP
    //   and overlaps right on top of it like an elevated card sheet
    // • Once fully arrived at the top, standard scrolling resumes
    // ─────────────────────────────────────────────────────────────
    const targetsSec = document.getElementById('development-targets');
    const servicesSec = document.getElementById('services-interactive');

    if (targetsSec && servicesSec) {
        ScrollTrigger.create({
            trigger: targetsSec,
            start: 'top top+=65',
            endTrigger: servicesSec,
            end: 'top top+=65',
            pin: true,
            pinSpacing: false
        });
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 6: Journey So Far – Key Milestones Parallax
    // Photo 1: User scrolls from #services-interactive
    // Photo 2: Section docks under navbar: title & landscape in place, timeline cards hidden below
    // Photo 3: Scrolling further: timeline cards rise up and peek from bottom fold
    // Photo 4 & 5: Timeline cards and track settle into perfect center
    // ─────────────────────────────────────────────────────────────
    const milestonesSec = document.getElementById('journey-milestones');
    const milestonesBg = document.querySelector('.milestones-bg-parallax');
    const milestonesTimeline = document.querySelector('.milestones-timeline-parallax');

    if (milestonesSec && milestonesTimeline) {
        // Timeline content smoothly rises from bottom to top (Photo 2 -> Photo 3 -> Photo 4/5)
        gsap.fromTo(milestonesTimeline,
            { y: 280, opacity: 0.15 },
            {
                y: 0,
                opacity: 1,
                ease: 'none',
                scrollTrigger: {
                    trigger: milestonesSec,
                    start: () => 'top top+=' + getNavHeight(), // pins cleanly under navbar when arriving
                    end: '+=450',
                    scrub: 1.0,
                    pin: true,
                    pinSpacing: true,
                    invalidateOnRefresh: true
                }
            }
        );

        // Background landscape gentle parallax float from bottom to top
        if (milestonesBg) {
            gsap.fromTo(milestonesBg,
                { y: 70 },
                {
                    y: 0,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: milestonesSec,
                        start: () => 'top top+=' + getNavHeight(),
                        end: '+=450',
                        scrub: 1.0
                    }
                }
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 7: Our Way of Working Parallax & Step-Wise Scroll
    // Photo 1: User scrolls from #journey-milestones: title enters, cards hidden
    // Photo 2: 2nd scroll: Row 1 (Safety & Integrity) rises smoothly from bottom to top
    // Photo 3: 3rd scroll: Section docks/pins under navbar, Row 2 (Customer & Operations) rises
    // Photo 4: 4th scroll: Row 3 (Sustainability & Collaboration) rises into place, all 6 cards settled
    // ─────────────────────────────────────────────────────────────
    // ─────────────────────────────────────────────────────────────
    // ANIMATION 7: Our Way of Working Parallax & 3-Step Scroll
    // Step 1 (Photo 1 / 1st Scroll): 2 cards appear (Row 1), both backgrounds at normal scale
    // Step 2 (Photo 2 / 2nd Scroll): 4 cards appear (Row 2), BOTH backgrounds zoom in in current position
    // Step 3 (Photo 3 / 3rd Scroll): All 6 cards appear (Row 3), left bg stays, right bg zooms & shifts right
    // ─────────────────────────────────────────────────────────────
    const ourWaySec = document.getElementById('our-way-of-working');
    const ourWayBgLeft = document.querySelector('.our-way-bg-left');
    const ourWayBgRight = document.querySelector('.our-way-bg-right');
    const ourWayRow1 = document.querySelectorAll('.our-way-row-1');
    const ourWayRow2 = document.querySelectorAll('.our-way-row-2');
    const ourWayRow3 = document.querySelectorAll('.our-way-row-3');

    if (ourWaySec) {
        // Initial state for rows
        gsap.set(ourWayRow1, { y: 60, opacity: 0 });
        gsap.set(ourWayRow2, { y: 70, opacity: 0 });
        gsap.set(ourWayRow3, { y: 80, opacity: 0 });

        // Set transform origins for smooth corner/side zoom
        if (ourWayBgLeft) {
            gsap.set(ourWayBgLeft, { transformOrigin: 'left center', scale: 1.0 });
        }
        if (ourWayBgRight) {
            gsap.set(ourWayBgRight, { transformOrigin: 'right center', scale: 1.0 });
        }

        // Step 1: As section enters from bottom (Image 1 state)
        // Row 1 (2 cards: Safety & Integrity) rises and fades in while Journey Milestones exits
        gsap.to(ourWayRow1, {
            y: 0,
            opacity: 1,
            ease: 'power1.out',
            stagger: 0.05,
            scrollTrigger: {
                trigger: ourWaySec,
                start: 'top 85%',
                end: () => 'top top+=' + getNavHeight(),
                scrub: 1.0,
                invalidateOnRefresh: true
            }
        });

        // Background subtle vertical parallax during approach
        if (ourWayBgLeft) {
            gsap.fromTo(ourWayBgLeft,
                { y: -40 },
                {
                    y: 0,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: ourWaySec,
                        start: 'top bottom',
                        end: () => 'top top+=' + getNavHeight(),
                        scrub: 1.0,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        if (ourWayBgRight) {
            gsap.fromTo(ourWayBgRight,
                { y: -40, x: 0 },
                {
                    y: 0,
                    x: 0,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: ourWaySec,
                        start: 'top bottom',
                        end: () => 'top top+=' + getNavHeight(),
                        scrub: 1.0,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        // Steps 2 & 3: Docked and pinned under navbar
        const pinnedTl = gsap.timeline();

        // ─── Step 2: 4 cards appear, BOTH backgrounds zoom in gently ───
        // Row 2 rises into view (Customer focus & Operational excellence)
        pinnedTl.to(ourWayRow2, {
            y: 0,
            opacity: 1,
            ease: 'sine.out',
            stagger: 0.05,
            duration: 0.5
        }, 0);

        // Both backgrounds zoom in smoothly in their current positions
        if (ourWayBgLeft) {
            pinnedTl.to(ourWayBgLeft, {
                scale: 1.15,
                ease: 'sine.out',
                duration: 0.5
            }, 0);
        }

        if (ourWayBgRight) {
            pinnedTl.to(ourWayBgRight, {
                scale: 1.15,
                x: 0,
                opacity: 1,
                ease: 'sine.out',
                duration: 0.5
            }, 0);
        }

        // ─── Step 3: All 6 cards appear, right background glides slow and smooth to the right ───
        // Row 3 rises into view (Sustainability & Collaboration)
        pinnedTl.to(ourWayRow3, {
            y: 0,
            opacity: 1,
            ease: 'sine.out',
            stagger: 0.05,
            duration: 0.75
        }, 0.5);

        // Left background remains visible and anchored on the left
        if (ourWayBgLeft) {
            pinnedTl.to(ourWayBgLeft, {
                y: 20,
                ease: 'none',
                duration: 0.75
            }, 0.5);
        }

        // Right background (refinery flame) shifts gently, slowly and smoothly to the right
        if (ourWayBgRight) {
            pinnedTl.to(ourWayBgRight, {
                scale: 1.22,
                x: 180,              // Gentle, slow drift to the right (was abrupt 380)
                opacity: 0.25,        // Soft fade keeping subtle presence
                ease: 'sine.inOut',  // Ultra-smooth sine easing with zero harsh jerks
                duration: 0.75
            }, 0.5);
        }

        ScrollTrigger.create({
            trigger: ourWaySec,
            start: () => 'top top+=' + getNavHeight(),
            end: '+=850',            // Extended scroll distance makes the rightward glide slow and graceful
            pin: true,
            pinSpacing: true,
            scrub: 1.8,              // Silky smooth inertia damping
            animation: pinnedTl,
            invalidateOnRefresh: true
        });
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 8: Why Choose AGPL Parallax & Bottom-to-Top Reveal
    // Top-left corner image and center screenshot hub graphic come from MORE BOTTOM
    // with smooth parallax travel as user scrolls from #our-way-of-working
    // ─────────────────────────────────────────────────────────────
    const whyChooseSec = document.getElementById('why-choose-agpl');
    const whyChooseBgLeft = document.querySelector('.why-choose-bg-left');
    const whyChooseBgRight = document.querySelector('.why-choose-bg-right');
    const whyChooseHeading = document.querySelector('.why-choose-heading');
    const whyChooseHub = document.querySelector('.why-choose-hub');

    if (whyChooseSec) {
        // 1. Heading smooth bottom-to-top reveal
        if (whyChooseHeading) {
            gsap.fromTo(whyChooseHeading,
                { y: 90, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: whyChooseSec,
                        start: 'top 85%',
                        end: 'top 35%',
                        scrub: 1.2,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        // 2. Center hub graphic (screenshot image content) comes from MORE BOTTOM with smooth parallax
        if (whyChooseHub) {
            gsap.fromTo(whyChooseHub,
                { y: 190, opacity: 0.1 },
                {
                    y: 0,
                    opacity: 1,
                    ease: 'power1.out',
                    scrollTrigger: {
                        trigger: whyChooseSec,
                        start: 'top 90%',
                        end: 'top 20%',
                        scrub: 1.2,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        // 3. Top-left corner decorative pipeline image comes from MORE BOTTOM with deep parallax
        if (whyChooseBgLeft) {
            gsap.fromTo(whyChooseBgLeft,
                { y: 180, opacity: 0.15 },
                {
                    y: -30,
                    opacity: 0.9,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: whyChooseSec,
                        start: 'top 95%',
                        end: 'bottom top',
                        scrub: 1.2,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        // 4. Bottom-right CNG station & car floating parallax (Photo 2)
        // Rises smoothly from bottom to top with deep parallax
        if (whyChooseBgRight) {
            gsap.fromTo(whyChooseBgRight,
                { y: 190, opacity: 0.15 },
                {
                    y: -40,
                    opacity: 0.9,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: whyChooseSec,
                        start: 'top 60%',
                        end: 'bottom 15%',
                        scrub: 1.2,
                        invalidateOnRefresh: true
                    }
                }
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 9: "Clean, Reliable Natural Gas" Section (#solutions)
    // • Trigger: Scrolling from #why-choose-agpl into #solutions
    // • Ultra-Slow, Smooth Fade: Opacity builds extra gradually across
    //   an extended scroll range (top 100% -> top 36%) with 2.4s scrub damping.
    // • Deep Bottom-to-Top Travel: Synchronized content (text + 4 cards/images)
    //   emerges from much deeper at the bottom (y: 240px -> 0px) for prominent parallax.
    // • Background Landscape: Slides right-to-left (x: 200 -> 0), settling softly.
    // • All elements lock gracefully into final resting position at ~45%-50% scroll.
    // ─────────────────────────────────────────────────────────────
    const solutionsSec = document.getElementById('solutions');
    const solutionsBg = document.querySelector('.solutions-bg-landscape');
    const solutionsContent = document.querySelector('.solutions-content-wrapper') || document.querySelectorAll('.solutions-content-left, .solutions-cards');

    if (solutionsSec) {
        const isMobile = window.innerWidth < 768;
        const startTrigger = isMobile ? 'top 98%' : 'top 100%';
        const endTrigger = isMobile ? 'top 32%' : 'top 36%';
        const scrubSmoothness = 2.4; // Extra-slow, ultra-soft scrub damping

        // 1. Whole section fades in extra slowly and gradually from 0% to 100% opacity
        gsap.fromTo(solutionsSec,
            { opacity: 0 },
            {
                opacity: 1,
                ease: 'sine.inOut',
                scrollTrigger: {
                    trigger: solutionsSec,
                    start: startTrigger,
                    end: endTrigger,
                    scrub: scrubSmoothness,
                    invalidateOnRefresh: true
                }
            }
        );

        // 2. Background landscape slides right to left with gentle, slow fade
        if (solutionsBg) {
            gsap.fromTo(solutionsBg,
                { x: isMobile ? 80 : 200, opacity: 0.1 },
                {
                    x: 0,
                    opacity: 1,
                    ease: 'sine.inOut',
                    scrollTrigger: {
                        trigger: solutionsSec,
                        start: startTrigger,
                        end: endTrigger,
                        scrub: scrubSmoothness,
                        invalidateOnRefresh: true
                    }
                }
            );
        }

        // 3. Text and Images rise together from DEEPER down at the bottom (y: 240 -> 0) with slow fade
        if (solutionsContent) {
            gsap.fromTo(solutionsContent,
                { y: isMobile ? 140 : 240, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    ease: 'sine.inOut',
                    scrollTrigger: {
                        trigger: solutionsSec,
                        start: startTrigger,
                        end: endTrigger,
                        scrub: scrubSmoothness,
                        invalidateOnRefresh: true
                    }
                }
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 10: "Capturing Our Journey" 2-Phase Parallax (#capturing-journey)
    // • Trigger: Scrolling from #solutions into #capturing-journey
    // • Phase 1: The whole section (container & header) rises smoothly from bottom to top
    //   with slow, gentle sine.inOut easing and gradual opacity fade.
    // • Phase 2 (Sequential): After the section enters, the 5 gallery image cards emerge
    //   from deeper below and glide upward into their grid positions with the same slow,
    //   gentle parallax scrub.
    // ─────────────────────────────────────────────────────────────
    const journeySec = document.getElementById('capturing-journey');
    const journeyHeader = document.querySelector('.journey-header');
    const journeyCards = document.querySelectorAll('.journey-card');

    if (journeySec) {
        const isMobile = window.innerWidth < 768;
        const initialCardY = isMobile ? 140 : 240;

        // Ensure cards are explicitly hidden and positioned down upfront to prevent double-show
        if (journeyCards.length > 0) {
            gsap.set(journeyCards, { opacity: 0, y: initialCardY });
        }

        const journeyTl = gsap.timeline({
            scrollTrigger: {
                trigger: journeySec,
                start: isMobile ? 'top 100%' : 'top 105%',
                end: isMobile ? 'top 10%' : 'top 12%',
                scrub: 2.8, // Ultra-slow, luxurious scrub damping
                invalidateOnRefresh: true
            }
        });

        // Phase 1: Whole section & header rise slowly from deep at the bottom with gentle fade
        journeyTl.fromTo(journeySec,
            { opacity: 0, y: isMobile ? 160 : 280 },
            {
                opacity: 1,
                y: 0,
                duration: 2.2, // Extended duration to make bottom-to-top rise noticeably slower
                ease: 'sine.inOut'
            }
        );

        if (journeyHeader) {
            journeyTl.fromTo(journeyHeader,
                { opacity: 0, y: isMobile ? 80 : 160 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 1.8,
                    ease: 'sine.inOut'
                },
                0 // synchronized with section entrance
            );
        }

        // Phase 2: After section enters, images emerge faster and crisply from bottom
        if (journeyCards.length > 0) {
            journeyTl.fromTo(journeyCards,
                { opacity: 0, y: initialCardY },
                {
                    opacity: 1,
                    y: 0,
                    stagger: 0.07,
                    duration: 0.85, // Faster, snappier image entrance
                    ease: 'power2.out',
                    immediateRender: false
                },
                ">-0.2" // begins as section settles into place
            );
        }
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 11: "Frequently Asked Questions" Section (#faq)
    // • Trigger: Scrolling from #capturing-journey into #faq
    // • Whole Section: Rises smoothly from deep below (y: 220 -> 0) with
    //   slow, gentle fade and parallax scrub, settling into current position.
    // ─────────────────────────────────────────────────────────────
    const faqSec = document.getElementById('faq');
    const faqWrapper = document.querySelector('.faq-content-wrapper');

    if (faqSec) {
        const isMobile = window.innerWidth < 768;
        const target = faqWrapper || faqSec;

        gsap.fromTo(target,
            { opacity: 0, y: isMobile ? 120 : 220 },
            {
                opacity: 1,
                y: 0,
                ease: 'sine.inOut',
                scrollTrigger: {
                    trigger: faqSec,
                    start: isMobile ? 'top 98%' : 'top 100%',
                    end: isMobile ? 'top 32%' : 'top 38%',
                    scrub: 2.2, // Slow, gentle scrub damping
                    invalidateOnRefresh: true
                }
            }
        );
    }

    // ─────────────────────────────────────────────────────────────
    // ANIMATION 12: Footer Section (#contact / footer)
    // • Trigger: Scrolling from #faq into the footer
    // • Whole Section: Comes from bottom (y: 200 -> 0) with smooth
    //   fade and parallax scrub, settling into its resting position.
    // ─────────────────────────────────────────────────────────────
    const footerSec = document.getElementById('contact');

    if (footerSec) {
        const isMobile = window.innerWidth < 768;

        gsap.fromTo(footerSec,
            { opacity: 0, y: isMobile ? 100 : 200 },
            {
                opacity: 1,
                y: 0,
                ease: 'sine.inOut',
                scrollTrigger: {
                    trigger: footerSec,
                    start: isMobile ? 'top 98%' : 'top 100%',
                    end: 'bottom bottom',
                    scrub: 2.2,
                    invalidateOnRefresh: true
                }
            }
        );
    }
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
