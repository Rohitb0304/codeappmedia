document.addEventListener('DOMContentLoaded', () => {
    // Function to fetch the particles.json configuration
        const isSignedIn = sessionStorage.getItem('isSignedIn');
        const authPopup = document.getElementById('auth-popup');
        const closePopupBtn = document.getElementById('close-popup');
        
        if (!isSignedIn) {
            authPopup.classList.remove('hidden');
            setTimeout(() => authPopup.style.opacity = 1, 10);
        }

        closePopupBtn.addEventListener('click', function() {
            authPopup.style.opacity = 0;
            setTimeout(() => authPopup.classList.add('hidden'), 500);
        });

        window.addEventListener('message', function(event) {
            if (event.data === 'signedIn') {
                sessionStorage.setItem('isSignedIn', 'true');
                authPopup.style.opacity = 0;
                setTimeout(() => authPopup.classList.add('hidden'), 500);
            }
        });

        
    async function loadParticlesConfig() {
        try {
            const response = await fetch('particles.json');
            if (!response.ok) {
                throw new Error('Failed to load particles.json');
            }
            const particlesConfig = await response.json();
            particlesJS('particles-js', particlesConfig);
        } catch (error) {
            console.error('Error loading particles configuration:', error);
        }
    }

    // Initialize Particle.js with the configuration
    loadParticlesConfig();
});
