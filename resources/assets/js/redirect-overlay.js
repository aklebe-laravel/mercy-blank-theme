const root = document.documentElement;

document.addEventListener('livewire:init', () => {
    // Show the overlay as soon as a Livewire response contains a redirect
    Livewire.hook('commit', ({succeed}) => {
        succeed(({effects}) => {
            if (effects?.redirect) {
                root.classList.add('is-redirecting');
            }
        });
    });
});

// Reset after SPA navigation (redirect(..., navigate: true)), since <html> is kept
document.addEventListener('livewire:navigated', () => root.classList.remove('is-redirecting'));

// Reset when the page is restored from the back/forward cache
window.addEventListener('pageshow', (e) => {
    if (e.persisted) {
        root.classList.remove('is-redirecting');
    }
});