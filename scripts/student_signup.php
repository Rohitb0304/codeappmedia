<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign Up</title>
    <link rel="stylesheet" href="../static/css/signup.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Firebase App (v8.0.0) -->
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-analytics.js"></script>

</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 class="title">Sign Up</h1>
            <div class="underline"></div>
            <form action="student_signup.php?redirect=<?php echo urlencode($redirect); ?>" method="post" id="signupForm" novalidate>
                <div class="input-field namefield">                    
                    <input type="text" id="first_name" name="first_name" required placeholder="First Name">
                    <label for="first_name">First Name</label>
                </div>

                <div class="input-field namefield">                    
                    <input type="text" id="last_name" name="last_name" required placeholder="Last Name">
                    <label for="last_name">Last Name</label>
                </div>

                <div class="input-field mailfield">
                    <input type="email" id="email" name="email" required placeholder="Email ID">
                    <label for="email">Email ID</label>
                </div>

                <div class="input-field phonefield">
                    <input type="text" id="mobile_number" name="mobile_number" required placeholder="Mobile Number">
                    <label for="mobile_number">Mobile Number</label>
                    <button id="sendOtp" class="verifybtn" type="button">Verify Number</button>
                </div>

                <div id="otpField" class="input-field" style="display: none;">
                    <input type="text" id="otp" name="otp" placeholder="Enter OTP">
                    <label for="otp">OTP</label>
                    <button id="verifyOtp" class="verifybtn" type="button">Verify OTP</button>
                    <p id="otpStatus"></p>
                </div>


                <div>
                    <input type="checkbox" id="sameAsWhatsapp" name="sameAsWhatsapp">
                    <label for="sameAsWhatsapp">WhatsApp number is the same as Contact Number</label>
                </div>

                <div class="input-field whatsappfield">                    
                    <input type="text" id="whatsapp_number" name="whatsapp_number" placeholder="WhatsApp Number">
                    <label for="whatsapp_number">WhatsApp Number</label>
                </div>

                <div class="input-field">
                    <input type="text" id="school_name" name="school_name" required placeholder="Name of School">
                    <label for="school_name">Name of School</label>
                </div>

                <div class="input-field">
                    <input type="text" id="city" name="city" required placeholder="City">
                    <label for="city">City</label>
                </div>

                <div class="input-field">
                    <input type="password" id="password" name="password" required placeholder="Password">
                    <label for="password">Password</label>
                </div>

                <?php if (isset($error)): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <?php if (isset($success)): ?>
                    <p class="success"><?= htmlspecialchars($success) ?></p>
                <?php endif; ?>

                <div class="btn-field">
                    <button class="signupbtn" type="submit">Sign Up</button>
                </div>

                <!-- Google Sign-In button -->
                <div class="google-signin-btn">
                    <button id="googleSignInBtn" type="button" class="btn"><i class="fab fa-google"></i> Sign Up with Google</button>
                </div>

                <div class="form-footer">
                    <p>Already have an account? <a href="student_signin.php?redirect=<?php echo urlencode($redirect); ?>" class="footer-link">Sign In</a></p>
                </div>
            </form>
        </div>        
    </div>

    <script>
    // Your Firebase config
    const firebaseConfig = {
        apiKey: "AIzaSyC7Kdeyr9iXqkpFrTBILGDkulgzoWevJxQ",
        authDomain: "code-app-media-auth.firebaseapp.com",
        databaseURL: "https://code-app-media-auth-default-rtdb.firebaseio.com",
        projectId: "code-app-media-auth",
        storageBucket: "code-app-media-auth.appspot.com",
        messagingSenderId: "957159302780",
        appId: "1:957159302780:web:99bd7fb7ca134e47578bf9"
    };
    firebase.initializeApp(firebaseConfig);
        firebase.analytics();

        const auth = firebase.auth();
        const sendOtpBtn = document.getElementById('sendOtp');
        const verifyOtpBtn = document.getElementById('verifyOtp');
        const otpField = document.getElementById('otpField');
        const otpStatus = document.getElementById('otpStatus');
        let confirmationResult;

        const formatPhoneNumber = (phone) => {
            if (phone.startsWith('+91')) {
                return phone;
            } else if (phone.startsWith('0')) {
                return '+91' + phone.substring(1);
            } else {
                return '+91' + phone;
            }
        };

        function setupRecaptcha() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sendOtp', {
                'size': 'invisible',
                'callback': function(response) {
                    // reCAPTCHA solved, allow signInWithPhoneNumber.
                },
                'expired-callback': function() {
                    otpStatus.innerText = "reCAPTCHA expired, please try again.";
                }
            });
        }

        sendOtpBtn.addEventListener('click', function() {
            let mobileNumber = document.getElementById('mobile_number').value;
            mobileNumber = formatPhoneNumber(mobileNumber);
            if (mobileNumber) {
                setupRecaptcha();
                const appVerifier = window.recaptchaVerifier;
                auth.signInWithPhoneNumber(mobileNumber, appVerifier)
                    .then((confirmationResultInstance) => {
                        confirmationResult = confirmationResultInstance;
                        otpField.style.display = 'block';
                        otpStatus.innerText = "OTP sent successfully.";
                    }).catch((error) => {
                        otpStatus.innerText = "Error sending OTP: " + error.message;
                    });
            } else {
                otpStatus.innerText = "Please enter a valid mobile number.";
            }
        });

        verifyOtpBtn.addEventListener('click', function() {
            const otp = document.getElementById('otp').value;
            if (otp) {
                confirmationResult.confirm(otp).then((result) => {
                    otpStatus.innerText = "OTP verified successfully!";
                    otpField.style.display = 'none';
                }).catch((error) => {
                    otpStatus.innerText = "Error verifying OTP: " + error.message;
                });
            } else {
                otpStatus.innerText = "Please enter a valid OTP.";
            }
        });

    // Optional: Google Sign-In
    document.getElementById('googleSignInBtn').addEventListener('click', function() {
        const provider = new firebase.auth.GoogleAuthProvider();
        auth.signInWithPopup(provider)
            .then((result) => {
                const token = result.credential.accessToken;
                const user = result.user;
                window.location.href = "<?php echo $redirect; ?>";
            }).catch((error) => {
                otpStatus.innerText = "Error during Google Sign-In: " + error.message;
            });
    });
    </script>

</body>
</html>