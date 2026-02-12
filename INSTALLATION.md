# Peanech ERP - Installation Guide

Complete step-by-step installation instructions for Windows, macOS, and Linux.

---

## 📋 Table of Contents

1. [Prerequisites](#prerequisites)
2. [Windows Installation](#windows-installation)
   - [Using Laragon (Recommended)](#using-laragon-recommended)
   - [Using XAMPP](#using-xampp)
   - [Using Native PHP](#using-native-php)
3. [macOS Installation](#macos-installation)
   - [Using Homebrew (Recommended)](#using-homebrew-recommended)
   - [Using MAMP](#using-mamp)
4. [Linux Installation](#linux-installation)
   - [Ubuntu/Debian](#ubuntudebian)
   - [CentOS/RHEL](#centosrhel)
5. [Docker Installation](#docker-installation)
6. [Post-Installation Setup](#post-installation-setup)
7. [Verification](#verification)
8. [Troubleshooting](#troubleshooting)

---

## Prerequisites

### Minimal System Requirements

- **PHP**: 8.5+ (PHP 8.1 minimum)
- **MySQL**: 5.7+ or MariaDB 10.3+
- **Node.js**: 16+ (for CSS compilation)
- **Composer**: 2.x
- **Redis**: 5.0+ (optional, for caching)
- **Memory**: 512MB RAM minimum
- **Disk**: 500MB free space

### Recommended Requirements

- **PHP**: 8.5+
- **MySQL**: 8.0+
- **Node.js**: 18+ LTS
- **Memory**: 2GB RAM
- **Disk**: 2GB free space

---

## Windows Installation

### Using Laragon (Recommended)

**Laragon** provides a modern, lightweight local development environment.

#### Step 1: Install Laragon

1. Download Laragon Full from [laragon.org](https://laragon.org/download/)
2. Run the installer (`laragon-wamp.exe`)
3. Choose installation directory (default: `C:\laragon`)
4. Complete the installation wizard

#### Step 2: Configure Laragon for PHP 8.5+

1. Open Laragon
2. Right-click Laragon tray icon → PHP → Version → Select PHP 8.1+ (or download newer version)
3. Verify: Right-click → PHP → PHP extensions → Ensure these are enabled:
   - `php_pdo_mysql`
   - `php_openssl`
   - `php_mbstring`
   - `php_curl`
   - `php_fileinfo`

#### Step 3: Start Services

1. Click **Start All** in Laragon
2. Verify MySQL and Apache are running (green indicators)

#### Step 4: Extract Project

1. Extract the ERP system files to: `C:\laragon\www\erp-system-web\`
2. Full path should be: `C:\laragon\www\erp-system-web\public\index.php`

#### Step 5: Install Dependencies

1. Open Laragon Terminal: Right-click Laragon → Terminal
2. Navigate to project:
   ```bash
   cd www/erp-system-web
   ```

3. Install Composer dependencies:
   ```bash
   composer install
   ```

4. Install Node.js dependencies:
   ```bash
   npm install
   ```

#### Step 6: Database Setup

**Option A: Using Laragon's HeidiSQL**

1. Right-click Laragon → Database → HeidiSQL
2. Create new database:
   ```sql
   CREATE DATABASE erp_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

**Option B: Using Command Line**

1. Open Laragon Terminal
2. Connect to MySQL:
   ```bash
   mysql -u root -p
   ```
3. Create database:
   ```sql
   CREATE DATABASE erp_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   EXIT;
   ```

#### Step 7: Environment Configuration

1. Copy `.env.example` to `.env`:
   ```bash
   copy .env.example .env
   ```

2. Edit `.env` and update database credentials:
   ```env
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=erp_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Generate application key (if not set):
   ```env
   JWT_SECRET=your-secret-key-here-change-this-in-production
   APP_KEY=base64:your-app-key-here
   ```

#### Step 8: Run Migrations

```bash
php cli/migrate.php
```

#### Step 9: Seed Database

```bash
php cli/seed.php
```

#### Step 10: Build CSS

```bash
npm run css:build
```

#### Step 11: Access Application

1. Start PHP built-in server:
   ```bash
   php -S localhost:8000 -t public
   ```

2. Open browser: `http://localhost:8000`

3. Login with default credentials:
   - **Email**: `admin@example.com`
   - **Password**: `password`

---

### Using XAMPP

#### Step 1: Install XAMPP

1. Download XAMPP from [apachefriends.org](https://www.apachefriends.org/)
2. Choose PHP 8.1+ version
3. Install to `C:\xampp`

#### Step 2: Start Services

1. Open XAMPP Control Panel
2. Start **Apache** and **MySQL**

#### Step 3: Extract Project

- Extract to: `C:\xampp\htdocs\erp-system-web\`

#### Step 4: Follow Steps 5-11 from Laragon Instructions

---

### Using Native PHP

#### Step 1: Install PHP 8.5+

1. Download PHP from [windows.php.net](https://windows.php.net/download/)
2. Choose **Thread Safe** version
3. Extract to: `C:\php85\`

#### Step 2: Configure PHP

1. Copy `php.ini-development` to `php.ini`
2. Edit `php.ini` and enable extensions:
   ```ini
   extension=pdo_mysql
   extension=openssl
   extension=mbstring
   extension=curl
   extension=fileinfo
   ```

3. Add PHP to PATH:
   - System Properties → Environment Variables
   - Edit `Path` variable → Add `C:\php85`

#### Step 3: Install MySQL

1. Download MySQL Installer from [dev.mysql.com](https://dev.mysql.com/downloads/)
2. Choose **Developer Default** setup
3. Set root password during installation

#### Step 4: Install Composer

1. Download from [getcomposer.org](https://getcomposer.org/download/)
2. Run installer
3. Verify: Open Command Prompt and run `composer --version`

#### Step 5: Install Node.js

1. Download LTS version from [nodejs.org](https://nodejs.org/)
2. Run installer
3. Verify: `node --version` and `npm --version`

#### Step 6: Follow Steps 4-11 from Laragon Instructions

---

## macOS Installation

### Using Homebrew (Recommended)

#### Step 1: Install Homebrew

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

#### Step 2: Install PHP

```bash
brew install php@8.5
brew link php@8.5
```

Verify:
```bash
php --version
```

#### Step 3: Install MySQL

```bash
brew install mysql
brew services start mysql
```

Secure installation:
```bash
mysql_secure_installation
```

#### Step 4: Install Composer

```bash
brew install composer
```

#### Step 5: Install Node.js

```bash
brew install node
```

#### Step 6: Extract Project

```bash
cd ~/Sites
unzip erp-system-web.zip
cd erp-system-web
```

#### Step 7: Install Dependencies

```bash
composer install
npm install
```

#### Step 8: Database Setup

```bash
mysql -u root -p
```

```sql
CREATE DATABASE erp_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

#### Step 9: Environment Configuration

```bash
cp .env.example .env
nano .env
```

Update database credentials in `.env`

#### Step 10: Run Migrations and Seed

```bash
php cli/migrate.php
php cli/seed.php
```

#### Step 11: Build CSS

```bash
npm run css:build
```

#### Step 12: Start Server

```bash
php -S localhost:8000 -t public
```

Visit: `http://localhost:8000`

---

### Using MAMP

#### Step 1: Install MAMP

1. Download MAMP from [mamp.info](https://www.mamp.info/)
2. Install MAMP (free version is sufficient)
3. Start MAMP servers

#### Step 2: Extract Project

- Extract to: `/Applications/MAMP/htdocs/erp-system-web/`

#### Step 3: Configure PHP

1. Open MAMP → Preferences → PHP
2. Select PHP 8.1+ version

#### Step 4: Follow macOS Homebrew Steps 7-12

---

## Linux Installation

### Ubuntu/Debian

#### Step 1: Update System

```bash
sudo apt update
sudo apt upgrade -y
```

#### Step 2: Install PHP 8.5+

```bash
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install -y php8.5 php8.5-cli php8.5-fpm php8.5-mysql php8.5-xml php8.5-mbstring php8.5-curl php8.5-zip php8.5-gd
```

#### Step 3: Install MySQL

```bash
sudo apt install -y mysql-server
sudo mysql_secure_installation
```

#### Step 4: Install Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
```

#### Step 5: Install Node.js

```bash
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

#### Step 6: Extract Project

```bash
cd /var/www
sudo unzip erp-system-web.zip
sudo chown -R $USER:$USER erp-system-web
cd erp-system-web
```

#### Step 7: Install Dependencies

```bash
composer install
npm install
```

#### Step 8: Database Setup

```bash
sudo mysql
```

```sql
CREATE DATABASE erp_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'erp_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON erp_system.* TO 'erp_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### Step 9: Environment Configuration

```bash
cp .env.example .env
nano .env
```

Update:
```env
DB_HOST=localhost
DB_DATABASE=erp_system
DB_USERNAME=erp_user
DB_PASSWORD=secure_password
```

#### Step 10: Run Migrations and Seed

```bash
php cli/migrate.php
php cli/seed.php
```

#### Step 11: Build CSS

```bash
npm run css:build
```

#### Step 12: Set Permissions

```bash
sudo chown -R www-data:www-data storage
sudo chmod -R 775 storage
```

#### Step 13: Start Server

**Development:**
```bash
php -S 0.0.0.0:8000 -t public
```

**Production (Configure Apache/Nginx):**
See [Deployment Guide](README.md#deployment) in README.md

---

### CentOS/RHEL

#### Step 1: Install PHP 8.5+

```bash
sudo yum install -y epel-release
sudo yum install -y https://rpms.remirepo.net/enterprise/remi-release-8.rpm
sudo dnf module reset php
sudo dnf module install php:remi-8.5
sudo dnf install -y php php-cli php-fpm php-mysqlnd php-xml php-mbstring php-curl php-zip php-gd
```

#### Step 2: Install MySQL

```bash
sudo dnf install -y mysql-server
sudo systemctl start mysqld
sudo systemctl enable mysqld
sudo mysql_secure_installation
```

#### Step 3: Follow Ubuntu Steps 4-13

---

## Docker Installation

### Prerequisites

- Docker 20.10+
- Docker Compose 2.0+

### Step 1: Create docker-compose.yml

```yaml
version: '3.8'

services:
  app:
    image: php:8.5-apache
    container_name: erp_app
    ports:
      - "8000:80"
    volumes:
      - ./:/var/www/html
    environment:
      DB_HOST: db
      DB_PORT: 3306
      DB_DATABASE: erp_system
      DB_USERNAME: erp_user
      DB_PASSWORD: secret
    depends_on:
      - db
    networks:
      - erp_network

  db:
    image: mysql:8.0
    container_name: erp_db
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: erp_system
      MYSQL_USER: erp_user
      MYSQL_PASSWORD: secret
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql
    networks:
      - erp_network

  redis:
    image: redis:7-alpine
    container_name: erp_redis
    ports:
      - "6379:6379"
    networks:
      - erp_network

networks:
  erp_network:
    driver: bridge

volumes:
  db_data:
```

### Step 2: Start Containers

```bash
docker-compose up -d
```

### Step 3: Install Dependencies

```bash
docker exec -it erp_app composer install
docker exec -it erp_app npm install
```

### Step 4: Run Migrations

```bash
docker exec -it erp_app php cli/migrate.php
docker exec -it erp_app php cli/seed.php
```

### Step 5: Build CSS

```bash
docker exec -it erp_app npm run css:build
```

### Step 6: Access Application

Visit: `http://localhost:8000`

---

## Post-Installation Setup

### Security Checklist

1. **Change Default Credentials**
   - Login and change admin password immediately
   - Navigate to: Settings → Change Password

2. **Update Environment File**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   JWT_SECRET=generate-strong-64-character-secret-key
   ```

3. **Set Proper File Permissions** (Linux/macOS)
   ```bash
   chmod -R 755 .
   chmod -R 775 storage
   chown -R www-data:www-data storage
   ```

4. **Disable Directory Listing** (Apache)
   - Ensure `.htaccess` has `Options -Indexes`

5. **Configure HTTPS** (Production)
   - Obtain SSL certificate (Let's Encrypt recommended)
   - Update `APP_URL` in `.env`

### Optional: Redis Caching

#### Install Redis (if not already installed)

**Windows:**
```bash
# Using Chocolatey
choco install redis-64
```

**macOS:**
```bash
brew install redis
brew services start redis
```

**Linux:**
```bash
sudo apt install redis-server
sudo systemctl start redis
sudo systemctl enable redis
```

#### Configure Redis in .env

```env
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null
```

### Email Configuration

Update `.env` with your mail server settings:

```env
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM=admin@yourcompany.com
```

**Popular SMTP Services:**
- **Mailtrap** (Development Testing)
- **SendGrid** (Production)
- **Amazon SES** (AWS)
- **Gmail** (Small Projects)

---

## Verification

### System Health Check

Run verification script:
```bash
php cli/test_db.php
```

Expected output:
```
✓ Database connection successful
✓ All tables exist
✓ Admin user exists
✓ Roles configured
```

### Manual Verification

1. **Database Tables**: Verify 22 tables exist:
   ```bash
   mysql -u root -p erp_system -e "SHOW TABLES;"
   ```

2. **PHP Extensions**: Check required extensions:
   ```bash
   php -m | grep -E "pdo_mysql|mbstring|openssl|curl"
   ```

3. **File Permissions**: Verify storage is writable:
   ```bash
   ls -la storage/
   ```

4. **CSS Compiled**: Check CSS file exists:
   ```bash
   ls -l public/css/app.css
   ```

### Access Application

1. Open browser: `http://localhost:8000`
2. You should see the landing page
3. Click "Login" → Use `admin@example.com` / `password`
4. Dashboard should load with metrics

---

## Troubleshooting

### Database Connection Failed

**Error**: `SQLSTATE[HY000] [2002] Connection refused`

**Solutions**:
1. Verify MySQL is running:
   ```bash
   # Windows (Laragon)
   Check Laragon → MySQL service is green
   
   # macOS
   brew services list
   
   # Linux
   sudo systemctl status mysql
   ```

2. Check database credentials in `.env`
3. Verify database exists:
   ```bash
   mysql -u root -p -e "SHOW DATABASES;"
   ```

### Migration Errors

**Error**: `Table 'users' already exists`

**Solution**: Drop and recreate database:
```sql
DROP DATABASE IF EXISTS erp_system;
CREATE DATABASE erp_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```
Then re-run: `php cli/migrate.php`

### CSS Not Loaded

**Error**: 404 on `app.css`

**Solution**:
```bash
npm run css:build
```

Verify file exists:
```bash
ls -l public/css/app.css
```

### Permission Denied (Linux/macOS)

**Error**: `Permission denied: storage/exports/`

**Solution**:
```bash
sudo chown -R $USER:www-data storage
sudo chmod -R 775 storage
```

### Composer Install Fails

**Error**: `Your requirements could not be resolved`

**Solution**:
1. Update Composer:
   ```bash
   composer self-update
   ```

2. Clear cache:
   ```bash
   composer clear-cache
   ```

3. Re-install:
   ```bash
   composer install --no-cache
   ```

### Port 8000 Already in Use

**Error**: `Address already in use`

**Solution**: Use different port:
```bash
php -S localhost:8080 -t public
```

Or kill existing process:
```bash
# Windows
netstat -ano | findstr :8000
taskkill /PID <PID> /F

# macOS/Linux
lsof -ti:8000 | xargs kill -9
```

### PHP Version Too Old

**Error**: `This package requires php ^8.5`

**Solution**:
- **Windows**: Download PHP 8.5+ from [windows.php.net](https://windows.php.net/)
- **macOS**: `brew install php@8.5`
- **Linux**: Use Ondrej PPA (see Linux installation)

---

## Directory Permissions Guide

### Recommended Permissions

```
755 - Directories (read, write, execute for owner; read, execute for group/others)
644 - Files (read, write for owner; read for group/others)
775 - Storage directory (read, write, execute for owner and group)
```

### Apply Permissions (Linux/macOS)

```bash
# Set directory permissions
find . -type d -exec chmod 755 {} \;

# Set file permissions
find . -type f -exec chmod 644 {} \;

# Set storage permissions
chmod -R 775 storage

# Set owner
sudo chown -R www-data:www-data .
```

---

## Next Steps

1. ✅ Read [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md) for project overview
2. ✅ Read [README.md](README.md) for features and usage
3. ✅ Change admin password
4. ✅ Configure email settings
5. ✅ Customize modules for your business
6. ✅ Set up scheduled tasks (see [Deployment](#deployment))
7. ✅ Configure backups

---

## Support

If you encounter issues not covered here:

1. Check [README.md Troubleshooting Section](README.md#troubleshooting)
2. Review application logs: `storage/logs/`
3. Check PHP error log
4. Verify all prerequisites are met

---

## License

This project is open-source and available under the MIT License.
