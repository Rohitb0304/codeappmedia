
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="../static/css/about.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>
  <!-- Hero Section -->
  <section class="hero">
    <img src="https://res.cloudinary.com/dsgd7p4bc/image/upload/v1723220225/imagine-a-sleek-workspace-for-ar-objects-technology--min_dp1ryh.png" alt="Hero Image" class="hero-image">
    <div class="hero-text">
      <h1 class="scroll-animation">We Build Tech</h1>
    </div>
  </section>

  <!-- Our Story Section -->
  <section class="our-story scroll-animation">
    <h2 class="scroll-animation">
      <span class="color-1">Our</span> <span class="color-2">Story</span>
    </h2>
    <p class="story-text">
      It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
    </p>
  </section>

  <!-- Our Steps Section -->
  <section class="our-steps scroll-animation">
    <h2 class="scroll-animation">
      <span class="color-1">Our</span> <span class="color-2">Steps</span>
    </h2>
    <div class="steps-container">
      <div class="step step-left scroll-animation">
        <div class="step-content">
          <div class="heading-line dream-heading heading-line-visible">
            <h2>Dream</h2>
          </div>
        </div>
        <p>Brief description of the dreaming phase, 
            limited to three lines.</p>
      </div>
      <div class="divider"></div>
      <div class="step step-center scroll-animation">
        <div class="step-content">
          <div class="heading-line discover-heading heading-line-visible">
            <h2>Discover</h2>
          </div>
        </div>
        <p>Brief description of the discovery phase, 
            limited to three lines.</p>
      </div>
      <div class="divider"></div>
      <div class="step step-right scroll-animation">
        <div class="step-content">
          <div class="connector"></div>
          <div class="heading-line create-heading heading-line-visible">
            <h2>Create</h2>
          </div>
        </div>
        <p>Brief description of the creation phase, 
            limited to three lines.</p>
      </div>
    </div>
  </section>

  <!-- Meet Our Founder Section -->
  <section class="meet-founder scroll-animation">
    <h2 class="animated-text">
      <span class="meet-our">Meet</span> <span class="our">Our</span> <span class="founder">Founder</span>
    </h2>
  <div class="founder-content">
      <img src="../static/images/sounder.jpg" alt="Founder" class="founder-image">
      <div class="founder-text">
          <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
      </div>
  </div>
</section>


  <!-- Team Section -->
  <section class="team scroll-animation">
    <h2>
      <span class="color-1">And</span> <span class="color-2">The Team</span>
    </h2>
    <div class="team-member">
      <img src="../static/images/team.jpg" alt="Team Member Image">
      <div class="member-text">
        <h3>Team Member 1</h3>
        <p>
          We dream and dream and 
          dream and we meet and then we again dream</p>
      </div>
    </div>
    <div class="team-member">
      <div class="member-text">
        <h3>Team Member 2</h3>
        <p>We dream and dream and 
          dream and we meet and then we again dream</p>
      </div>
      <img src="../static/images/team.jpg" alt="Team Member Image">
    </div>

  </section>

  <!-- Get In Touch Section -->
<section id="contact" class="get-in-touch scroll-animation">
  <div class="contact-container scroll-animation">
      <!-- Left Container -->
      <div class="left-container">
          <h2><span class="color-1">Having Some Questions?</span><br> <span class="color-2">Get In Touch</span></h2>
          <form action="#" method="post">
              <div class="form-group">
                  <!-- <label for="name">Name</label> -->
                  <input type="text" id="name" placeholder="Your Full Name" name="name" required>
              </div>
              <div class="form-group">
                  <!-- <label for="email">Email</label> -->
                  <input type="email" id="email" placeholder="Enter your email" name="email" required>
              </div>
              <div class="form-group">
                  <!-- <label for="phone">Phone</label> -->
                  <input type="tel" id="phone" placeholder="Phone Number" name="phone" required>
              </div>
              <div class="form-group">
                  <!-- <label for="city">City</label> -->
                  <input type="text" id="city" placeholder="Your City" name="city" required>
              </div>
              <div class="form-group">
                  <!-- <label for="message">Message</label> -->
                  <textarea id="message" name="message" placeholder="Please write your query here" required></textarea>
              </div>
              <button type="submit" class="button">Send Message</button>
          </form>
      </div>
      <!-- Right Container -->
      <div class="right-container scroll-animation">
          <div class="contact-info">
              <h3>Talk to Us</h3>
              <p><i class="fas fa-phone icon"></i> +91 - 1234567890</p>

              <h3>Email Us</h3>
              <a href="#"><p><i class="fas fa-envelope icon"></i> contact@codeappmedia.com</p></a>

              <h3>Visit Us</h3>
              <p><i class="fas fa-map-marker-alt icon"></i>Aurangabad, Maharashtra</p>

              <div class="follow">
              <h3>Follow us on : </h3>
              <div class="social-media-links">
                  <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                  <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                  <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                  <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
              </div>
            </div>
          </div>
      </div>
  </div>
</section>

<script>

    // Scroll animation for sections
    const elements = document.querySelectorAll('.scroll-animation');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    elements.forEach(element => {
        observer.observe(element);
    });
    
    // Additional scroll behavior for steps section
    document.addEventListener('scroll', function() {
      const steps = document.querySelectorAll('.step');
      steps.forEach((step, index) => {
        const position = step.getBoundingClientRect().top;
        if (position < window.innerHeight - 50) {
          step.classList.add('step-visible');
        }
      });
    });

    document.addEventListener('DOMContentLoaded', () => {
  const animatedText = document.querySelector('.animated-text');

  // Function to wrap each character in a span
  function animateText(textElement) {
    const text = textElement.textContent;
    textElement.innerHTML = text.split('').map(char => `<span>${char}</span>`).join('');
  }

  // Apply the animation
  animateText(document.querySelector('.meet-our'));
  animateText(document.querySelector('.our'));
  animateText(document.querySelector('.founder'));

  // Function to start the animation
  function startAnimation() {
    document.querySelectorAll('.animated-text span').forEach((span, index) => {
      setTimeout(() => {
        span.classList.add('visible');
      }, index * 50); // Adjust delay as needed
    });
  }

  // Observer to trigger animation when element is in view
  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startAnimation(); // Start animation when element comes into view
        observer.unobserve(entry.target); // Stop observing after animation starts
      }
    });
  }, { threshold: 0.1 });

  // Observe animated-text sections
  document.querySelectorAll('.animated-text').forEach(element => observer.observe(element));
});

  

    
  </script>
</body>
</html>
<?php include 'footer.php'; ?>