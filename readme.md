# Project Setup with Firebase, Google Authenticator, and MySQL

This project uses Firebase for backend services, integrates Google Authenticator for 2FA, and uses MySQL for database management. This guide will walk you through setting up the environment, installing dependencies, and configuring the application.

---

## Prerequisites

- **XAMPP** (Apache, PHP, MySQL)
- **Composer** (PHP dependency manager)
- **PHP 7.2+**
- **MySQL** (comes bundled with XAMPP)

---

## Installation

### 1. Set Up XAMPP

#### **Download and Install XAMPP:**
   - Download XAMPP from [Apache Friends](https://www.apachefriends.org/index.html).
   - Install and start Apache and MySQL modules via the XAMPP Control Panel.

#### **Configure MySQL:**
   - Open phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Create a new database for your project.

### 2. Configure Project Directory

#### **Clone or Download the Project:**
   - Place your project files in the `htdocs` directory of XAMPP. For example, `C:\xampp\htdocs\your-project` (Windows) or `/Applications/XAMPP/htdocs/your-project` (macOS).

#### **Set Up Environment Variables:**
   - Create a `.env` file in your project root with the following content (adjust as needed):

   ```ini
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=root
   DB_PASSWORD=
   
   FIREBASE_PROJECT_ID=your_firebase_project_id
   FIREBASE_API_KEY=your_firebase_api_key
   FIREBASE_AUTH_DOMAIN=your_firebase_auth_domain
   ```

### 3. Install Composer Dependencies

Run the following command in your project's root directory (where `composer.json` is located):

```bash
composer install
```

This will install the following packages:

- `kreait/firebase-php` - Firebase PHP SDK
- `robthree/twofactorauth` - Google Authenticator (2FA)
- `sonata-project/google-authenticator` - Google Authenticator for 2FA

### 4. Autoload Configuration

Ensure your `composer.json` includes the PSR-4 autoload configuration:

```json
"autoload": {
    "psr-4": {
        "App\\": "src/App/"
    }
}
```

After modifying `composer.json`, run:

```bash
composer dump-autoload
```

### 5. Database Configuration

#### **Migrate Database Tables:**
   - Ensure your database is set up as required by your application.
   - Use migrations or manually create tables if required.

#### **Connect to the Database:**
   - The application should automatically connect to the MySQL database using the credentials provided in the `.env` file.

---

## Starting Apache and MySQL Servers Using Command Line

### For **Windows**:

1. **Open Command Prompt as Administrator.**
2. **Navigate to XAMPP folder**:
   ```bash
   cd C:\xampp
   ```
3. **Start Apache and MySQL:**
   - Apache: 
     ```bash
     xampp-control.exe --start Apache
     ```
   - MySQL:
     ```bash
     xampp-control.exe --start MySQL
     ```

4. Alternatively, you can use:
   - Apache: 
     ```bash
     sc start Apache2.4
     ```
   - MySQL:
     ```bash
     sc start mysql
     ```

### For **Linux**:

1. **Open Terminal** and navigate to XAMPP installation directory:
   ```bash
   cd /opt/lampp
   ```
2. **Start Apache and MySQL:**
   ```bash
   sudo ./xampp start
   ```

3. If you prefer to start services individually:
   - Apache: 
     ```bash
     sudo ./lampp startapache
     ```
   - MySQL:
     ```bash
     sudo ./lampp startmysql
     ```

### For **macOS**:

1. **Open Terminal** and navigate to the XAMPP folder:
   ```bash
   cd /Applications/XAMPP/xamppfiles
   ```

2. **Start Apache and MySQL:**
   - Apache:
     ```bash
     sudo ./bin/apachectl start
     ```
   - MySQL:
     ```bash
     sudo ./bin/mysql.server start
     ```

3. **Stop services:**
   - Apache:
     ```bash
     sudo ./bin/apachectl stop
     ```
   - MySQL:
     ```bash
     sudo ./bin/mysql.server stop
     ```

---

## Usage

### 1. Firebase Integration

- The `kreait/firebase-php` package provides a comprehensive Firebase integration. Follow the [official documentation](https://firebase-php.readthedocs.io/en/stable/) for configuring Firebase services such as Authentication, Firestore, and Realtime Database.

### 2. Google Authenticator Setup

- To implement Google Authenticator, use the `robthree/twofactorauth` package. You can generate a QR code for the user to scan and validate the 2FA code as follows:

```php
$twoFA = new \RobThree\Auth\TwoFactorAuth('YourAppName');
$secret = $twoFA->createSecret();
$qrCodeUrl = $twoFA->getQRCodeImageAsDataUri('YourAppName', $secret);

// Display QR code in your view
echo '<img src="' . $qrCodeUrl . '" />';
```

### 3. Starting the Application

1. **Start Apache and MySQL:**
   - Ensure Apache and MySQL are running via the XAMPP Control Panel or command line.
   
2. **Access the Application:**
   - Open your browser and navigate to `http://localhost/your-project`.

### 4. Testing the Setup

- Verify Firebase integration by testing the authentication and database services.
- Test Google Authenticator by setting up 2FA for a user account and ensuring the code verification works as expected.

---

## Troubleshooting

- **Database Connection Issues:** Ensure the MySQL server is running and that your credentials in the `.env` file are correct.
- **Composer Issues:** If `composer install` fails, ensure Composer is correctly installed and accessible from the command line.
- **Permissions Issues on macOS/Linux:** Ensure that the log files and directories have appropriate permissions using `chmod` or run services as `sudo`.

---

## Additional Resources

- [Firebase PHP Documentation](https://firebase-php.readthedocs.io/en/stable/)
- [Google Authenticator Integration with PHP](https://github.com/RobThree/TwoFactorAuth)
- [XAMPP Documentation](https://www.apachefriends.org/index.html)

---