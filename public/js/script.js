document.addEventListener('DOMContentLoaded', () => {
    const asides = document.querySelectorAll('aside');

    asides.forEach(aside => {
        const links = aside.querySelectorAll('.icon-link');

        links.forEach(link => {
            const img = link.querySelector('img');
            const defaultSrc = link.dataset.default;
            const hoverSrc = link.dataset.hover;
            const activeSrc = link.dataset.active;

            // Preload images
            [defaultSrc, hoverSrc, activeSrc].forEach(src => {
                const preload = new Image();
                preload.src = src;
            });

            // Set initial image based on active class
            img.src = link.classList.contains('active') ? activeSrc : defaultSrc;

            // Hover events
            link.addEventListener('mouseenter', () => {
                if (!link.classList.contains('active')) {
                    img.src = hoverSrc;
                }
            });

            link.addEventListener('mouseleave', () => {
                if (!link.classList.contains('active')) {
                    img.src = defaultSrc;
                }
            });

            // Click event
            link.addEventListener('click', (e) => {
                e.preventDefault();

                // Remove active from all links
                document.querySelectorAll('.icon-link.active').forEach(other => {
                    other.classList.remove('active', 'bg-purple-500', 'text-white');
                    const otherImg = other.querySelector('img');
                    if (otherImg) otherImg.src = other.dataset.default;
                });

                // Activate clicked
                link.classList.add('active', 'bg-purple-500', 'text-white');
                img.src = activeSrc;

                // Navigate
                window.location.href = link.getAttribute('href');
            });
        });
    });

    // Optional: Fade-in effect
    setTimeout(() => {
        document.body.classList.add('js-ready');
    }, 100);

    document.querySelectorAll(".truncate-text").forEach(el => {
        // Check if content is overflowing (truncated)
        if (el.scrollHeight > el.clientHeight || el.scrollWidth > el.clientWidth) {
            el.classList.add("truncated");
        }

        // Toggle expand/collapse
        el.addEventListener("click", () => {
            if (el.classList.contains("truncated")) {
                el.classList.toggle("expanded");
            }
        });
    });
});