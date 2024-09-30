<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        /* Add your header styles here */
        .user-info {
            display: flex;
            align-items: center;
        }
        .greeting-message {
            font-size: 16px;
            color: #8F00FF;
            margin-right: 20px;
            display: inline-block;
            cursor: pointer; /* Make the greeting message clickable */
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #272727;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            right: 0;
            top: 100%;
            border-radius: 5px;
            z-index: 1;
            min-width: 160px;
            white-space: nowrap;
        }
        .dropdown-content a {
            color: rgb(255, 255, 255);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #373737;
        }
        .dropdown-content::before {
            content: "";
            position: absolute;
            top: -10px;
            right: 10px;
            border-width: 0 10px 10px 10px;
            border-style: solid;
            border-color: transparent transparent #272727 transparent;
        }
        .dropdown-content.show {
            display: block;
        }
        .toggle_btn {
            display: none; /* Adjust or remove as needed */
        }
        .dropdown_menu {
            display: none; /* Adjust or remove as needed */
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="#">CodeAppMedia</a></div>
            <ul class="links">
                <li><a href="../pages/hero.html">Home</a></li>
                <li><a href="../pages/courses.html">Courses</a></li>
                <li><a href="../pages/compiler-using-rapidapi.html">Compilers</a></li>
                <li><a href="../pages/about.html">About</a></li>
                <li><a href="../pages/ar-lab.html">AR Lab</a></li>
            </ul>
            <div id="user-info" class="user-info">
                <span id="greeting-message" class="greeting-message">Welcome</span>
                <div class="dropdown-content">
                    <a href="../pages/settings.html">Settings</a>
                    <a href="javascript:void(0)" id="logout">Logout</a>
                </div>
            </div>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="dropdown_menu">
            <li><a href="../pages/hero.html">Home</a></li>
            <li><a href="../pages/courses.html">Courses</a></li>
            <li><a href="../pages/compiler-using-rapidapi.html">Compilers</a></li>
            <li><a href="../pages/about.html">About</a></li>
            <li><a href="../pages/ar-lab.html">AR Lab</a></li>
        </div>
    </header>

    <!-- Page Content for Courses -->
    <main>
        <!-- Your content for the courses page goes here -->
        <h1>Hello</h1>
    </main>

    <script type="module">
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.12.1/firebase-app.js';
        import { getAuth, onAuthStateChanged, signOut } from 'https://www.gstatic.com/firebasejs/9.12.1/firebase-auth.js';
        import { getFirestore, doc, getDoc } from 'https://www.gstatic.com/firebasejs/9.12.1/firebase-firestore.js';

        const firebaseConfig = {
            apiKey: "AIzaSyC7Kdeyr9iXqkpFrTBILGDkulgzoWevJxQ",
            authDomain: "code-app-media-auth.firebaseapp.com",
            projectId: "code-app-media-auth",
            storageBucket: "code-app-media-auth.appspot.com",
            messagingSenderId: "957159302780",
            appId: "1:957159302780:web:99bd7fb7ca134e47578bf9"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const db = getFirestore(app);

        document.addEventListener('DOMContentLoaded', () => {
            const userInfo = document.getElementById('user-info');
            const greetingMessage = document.getElementById('greeting-message');
            const dropdownContent = document.querySelector('.dropdown-content');

            greetingMessage.addEventListener('click', () => {
                dropdownContent.classList.toggle('show');
            });

            document.addEventListener('click', (event) => {
                if (!greetingMessage.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.classList.remove('show');
                }
            });

            onAuthStateChanged(auth, async (user) => {
                if (user) {
                    try {
                        const userDocRef = doc(db, 'users', user.uid);
                        const userDoc = await getDoc(userDocRef);
                        if (userDoc.exists()) {
                            const userEmail = user.email || 'user@example.com';
                            greetingMessage.innerHTML = `Welcome, ${userEmail}`;
                        } else {
                            greetingMessage.innerHTML = `Welcome, ${user.email || 'User'}`;
                        }
                    } catch (error) {
                        console.error('Error fetching user data:', error);
                        greetingMessage.innerHTML = `Welcome, ${user.email || 'User'}`;
                    }

                    userInfo.style.display = 'flex';

                    document.getElementById('logout').addEventListener('click', () => {
                        signOut(auth).then(() => {
                            window.location.href = '../pages/signin.html';
                        }).catch((error) => {
                            console.error('Sign-out error:', error);
                        });
                    });
                } else {
                    if (window.location.pathname.includes('ar-lab.html')) {
                        window.location.href = '../pages/signin.html';
                    }
                    userInfo.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>