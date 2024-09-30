<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeApp Media</title>
    <link rel="stylesheet" href="../static/css/hero.css">
    <link rel="stylesheet" href="../static/css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" defer></script>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <?php if (!$isAuthenticated): ?>
        <div id="auth-popup" class="auth-popup hidden" role="dialog" aria-labelledby="auth-popup-title" aria-hidden="true">
            <div class="auth-popup-content">
                <button class="close-popup" id="close-popup" aria-label="Close">&times;</button>
                <div class="h2-bg">
                    <h2 id="auth-popup-title">CodeApp Media</h2>
                </div>
                <div class="button-container">
                    <button class="signin-btn"><a href="../scripts/student_signin.php" title="Sign In" rel="noopener noreferrer">Sign In</a></button>
                    <button class="signup-btn"><a href="../scripts/student_signup.php" title="Sign Up" rel="noopener noreferrer">Sign Up</a></button>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        

    <div class="carousel-container">
        <div class="carousel">
            <div class="carousel-slide">
                <img src="https://res.cloudinary.com/dsgd7p4bc/image/upload/v1723220352/a-clean-simple-realistic-image-of-3-neurons-above-a-book-in-air-being-shown-using-ar-technology-sid_3_o7tnoh.jpg" alt="Slide Image" />
                <div class="carousel-text">
                    <h1>Bringing textbooks to life with Augmented Reality</h1>
                    <a href="compilers.php"><button class="ghost-btn">Learn More</button></a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="https://res.cloudinary.com/dsgd7p4bc/image/upload/v1723220353/a-realistic-image-of-a-girl-using-phone-to-study-3d-brain-using-ar-technology-in-front-of-her_1_jtuwlk.jpg" alt="Slide Image" />
                <div class="carousel-text">                    
                    <h1>Explore courses on AR with Python</h1>
                    <a href="courses.php"><button class="ghost-btn">Learn More</button></a>
                </div>
            </div>
            <div class="carousel-slide">
                <img src="https://res.cloudinary.com/dsgd7p4bc/image/upload/v1723220494/developer-8829735_1920_z1p4aw.jpg" alt="Slide Image" />
                <div class="carousel-text">
                    <h1>Choose from our curated free compilers</h1>                    
                    <button class="ghost-btn">Learn More</button>
                </div>
            </div>
            <!-- <div class="carousel-slide">
                <img src="https://res.cloudinary.com/dsgd7p4bc/image/upload/v1723053395/magical-virtual-reality-games-using-hololens-generative-ai-2000x1121_lqv4yn.jpg" alt="Slide Image" />
                <div class="carousel-text">
                    <h1>Slide Title</h1>
                    <p>Slide description goes here.</p>
                    <button class="ghost-btn">Learn More</button>
                </div>
            </div> -->
            <div class="wave-container">
                <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
                    <path d="M0,224L60,192C120,160,240,96,360,112C480,128,600,224,720,256C840,288,960,256,1080,240C1200,224,1320,224,1380,224L1440,224L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z" fill="#AE46FF"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="compilers-info scroll-animation">
        <p class="scroll-animation">Our <span class="highlight">Java</span> and <span class="highlight">Python</span> compilers are free to use.</p>
        <div class="button-container">
            <div class="line"></div>
            <a href="compilers.php"><button class="start-button scroll-animation">Get Set Compile</button></a>
            <div class="line"></div>
        </div>
        <p><span class="game-game scroll-animation">Games</span> are the best way to learn code</p>
        <a href="maze-game.php"><button class="game-button scroll-animation">Play a Game?</button></a>
        <p class="welcome scroll-animation">Welcome to our coding app for students! Master <span class="highlight">Java</span> and <span class="highlight">Python</span> with our interactive platform and start building your future today.</p>
        <div class="button-container scroll-animation">
            <div class="line"></div>
            <a href=""><button class="start-button scroll-animation">Get Started</button></a>
            <div class="line"></div>
        </div>        
    </div>

    <section class="courses scroll-animation">
    <!-- First Card -->
    <div class="card scroll-animation">
        <div class="card-content">
            <h2>Create your AR Lab</h2>
            <p>Using CodeAppMedia you can create your own AR labs.</p>
        </div>
        <div class="btn-container">
            <div class="string"></div>
            <a href="signin.html" class="course-btn">
                <span>Start Free</span>
            </a>
        </div>
    </div>

    <!-- Second Card -->
    <div class="card scroll-animation">
        <div class="card-content">
            <h2>Explore our Labs</h2>
            <p>Explore the AR preset labs with our trained model.</p>
        </div>
        <div class="btn-container">
            <div class="string"></div>
            <a href="#" class="course-btn">
                <span>Start Free</span>
            </a>
        </div>
    </div>

    <!-- Third Card -->
    <div class="card scroll-animation">        
        <div class="card-content">
            <h2>Get Lab for organization</h2>
            <p>Need our service? Just feel free to contact.</p>
        </div>
        <div class="btn-container">
            <div class="string"></div>
            <a href="#" class="course-btn">
                <span>Start Free</span>
            </a>
        </div>
    </div>

    <!-- Extra Card -->
    <div class="extra-card scroll-animation">
        <h2>Stuck in code?</h2>
        <p>Start with a Free Course</p>
        <div class="btn-container">
            <!-- <div class="string"></div> -->
            <a href="#" class="extra-btn">Get Started</a>
        </div>
    </div>
</section>



<section class="ar-service-section">
    <div class="ar-service-cards scroll-animation">
        <h1>Discover Our AR Lab Offerings</h1>
        <div class="cards-container">
            <!-- Card 1 -->
            <div class="ar-card scroll-animation">
                <h2>Labs Deployment</h2>
                <div class="svg-container">
                    <img src="../static/svgs/card-1.svg" alt="Tick Icon" />
                </div>
                <h3>Training <br>‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎</h3>
                <p>
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Training to teachers</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Special Coding Environment</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Lifetime Free Workshops</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Development of AR Application</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Message 5</li>
                    </ul>
                </p>
                <a href="#" class="ar-btn">
                    <span>Learn More</span>
                </a>
            </div>
            <!-- Card 2 -->
            <div class="ar-card scroll-animation">
                <h2>Consultancy</h2>
                <div class="svg-container">
                    <img src="../static/svgs/card-2.svg" alt="Tick Icon" />
                </div>
                <h3>Data Engineering and Services</h3>
                <p>
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Data Pipeline Development</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Data Storage Solutions</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Custom Data Solutions</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Advanced Analytics</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Message 5</li>
                    </ul>
                </p>
                <a href="#" class="ar-btn">
                    <span>Learn More</span>
                </a>
            </div>
            <!-- Card 3 -->
            <div class="ar-card scroll-animation">
                <h2>Custom Solutions</h2>
                <div class="svg-container">
                    <img src="../static/svgs/card-3.svg" alt="Tick Icon" />
                </div>
                <h3>Custom Design and Development</h3>
                <p>
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Tailor-Made Solutions</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Interactive Experiences</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Comprehensive Support</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 15 15"><path fill="8F00FF" fill-rule="evenodd" d="M0 7.5a7.5 7.5 0 1 1 15 0a7.5 7.5 0 0 1-15 0m7.072 3.21l4.318-5.398l-.78-.624l-3.682 4.601L4.32 7.116l-.64.768z" clip-rule="evenodd"/></svg> Message 5</li>
                    </ul>
                </p>
                <a href="#" class="ar-btn">
                    <span>Learn More</span>
                </a>
            </div>
        </div>
    </div>
</section>



<section class="trusted-container scroll-animation">
    <div class="trusted-content scroll-animation">
        <h2>Trusted by Students and Teachers</h2>
        <div class="counts scroll-animation">
            <div class="count-item scroll-animation">
            <p class="scroll-animation"><span class="count-number" data-target="1000">0</span>+</p>
                <span class="count-label">Users</span>
            </div>
            <div class="count-item">
            <p class="scroll-animation"><span class="count-number" data-target="200">0</span>+</p>
                <span class="count-label">Happy Customers</span>
            </div>
            <div class="count-item">
            <p class="scroll-animation"><span class="count-number" data-target="150">0</span>+</p>
                <span class="count-label">Courses</span>
            </div>
            <div class="count-item">
                <p class="scroll-animation"><span class="count-number" data-target="50">0</span>+</p>
                <span class="count-label">Partners</span>
            </div>
        </div>
    </div>
</section>
        <section class="custom-card-container scroll-animation">
            <div class="custom-card">
                <div class="custom-image">
                    <img src="https://res.cloudinary.com/dsgd7p4bc/image/upload/v1723220024/unseen-studio-s9CC2SKySJM-unsplash_eljyue.jpg" alt="Custom Image 1">
                </div>
                <div class="custom-text">
                    <h2>Student?</h2>
                    <p>Get the tools and support you need.</p>
                    <p>Dive in and start learning with us today.</p>
                </div>
            </div>
            <div class="custom-card">
                <div class="custom-image">
                    <img src="https://res.cloudinary.com/dsgd7p4bc/image/upload/v1723220025/lycs-architecture-U2BI3GMnSSE-unsplash_lxfsmu.jpg" alt="Custom Image 2">
                </div>
                <div class="custom-text">
                    <h2>Organization?</h2>
                    <p>Equip your students with the best resources and support.</p>
                    <p>Connect with us now</p>
                    <a href="about.php#contact"><button>Contact</button></a>
                </div>
                </button>
            </div>
        </section>
<div id="particles-js"></div>
                
<script>
    document.addEventListener('DOMContentLoaded', () => {
    // Intersection Observer for scroll animations
    const elements = document.querySelectorAll('.scroll-animation');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target); // Unobserve after animation to improve performance
            }
        });
    }, {
        threshold: 0.1 // Trigger animation when 10% of the element is visible
    });

    elements.forEach(element => observer.observe(element));

    // Initialize Particle.js with configuration
    async function loadParticlesConfig() {
        try {
            const response = await fetch('../static/js/particles.json');
            if (!response.ok) throw new Error('Failed to load particles.json');
            const particlesConfig = await response.json();
            particlesJS('particles-js', particlesConfig);
        } catch (error) {
            console.error('Error loading particles configuration:', error);
        }
    }

    loadParticlesConfig();

    // Carousel Functionality
    const slides = document.querySelectorAll('.carousel-slide');
    const totalSlides = slides.length;
    let currentIndex = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.transform = `translateX(${(i - index) * 100}%)`;
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    }

    showSlide(currentIndex); // Show the initial slide
    setInterval(nextSlide, 3000); // Auto-transition every 3 seconds

    // Counter Animation
    const counters = document.querySelectorAll('.count-number');

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / 50; // 50 steps for smooth transition
            const duration = 1000; // 1-second animation

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, duration / 50);
            } else {
                counter.innerText = target;
            }
        };

        updateCount();
    });

    // Authentication Popup
    const authPopup = document.querySelector('#auth-popup');
    if (authPopup) {
        authPopup.classList.add('show');

        document.querySelector('#close-popup').addEventListener('click', () => {
            authPopup.classList.remove('show');
        });
    }
});

</script>

<?php include 'footer.php'; ?>

</body>
</html>