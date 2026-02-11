# 🚀 PEANECH ERP - Enterprise Resource Planning System

<div align="center">

![PEANECH ERP](https://img.shields.io/badge/PEANECH-ERP-blue?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8.5+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.1+-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**A comprehensive, modern, full-stack Enterprise Resource Planning system built with PHP (no frameworks), Tailwind CSS, and MySQL.**

[Features](#-features) • [Demo](#-demo) • [Installation](#-installation) • [Documentation](#-documentation) • [Security](#-security)

</div>

---

## 📋 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Screenshots](#-screenshots)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Quick Start](#-quick-start)
- [Project Structure](#-project-structure)
- [Available Commands](#-available-commands)
- [Configuration](#-configuration)
- [Security Features](#-security-features)
- [Database Schema](#-database-schema)
- [API Documentation](#-api-documentation)
- [Development](#-development)
- [Deployment](#-deployment)
- [Contributing](#-contributing)
- [License](#-license)
- [Support](#-support)

---

## 🎯 About

**PEANECH ERP** is a complete, production-ready Enterprise Resource Planning system designed to streamline business operations across HR, inventory, sales, and accounting departments. Built with modern web technologies and best practices, it provides a comprehensive solution for businesses of all sizes.

### Why PEANECH ERP?

- ✅ **No Framework Dependency** - Pure PHP 8.5+ with clean MVC architecture
- ✅ **Modern UI/UX** - Beautiful, responsive design with Tailwind CSS 4.1+
- ✅ **Enterprise Security** - JWT authentication, Argon2id hashing, RBAC
- ✅ **Production Ready** - Complete with audit logs, CSRF protection, and optimization
- ✅ **Highly Extensible** - Clean architecture makes customization easy
- ✅ **Well Documented** - 2000+ lines of comprehensive documentation

---

## ✨ Features

### 🔐 Authentication & Security
- **JWT Token Authentication** - Secure access tokens (15-min) and refresh tokens (7-day)
- **Password Security** - Argon2id hashing with salt
- **Social Login Ready** - Google, Microsoft, GitHub, LinkedIn integration prepared
- **CSRF Protection** - Global enforcement on all POST requests
- **Role-Based Access Control** - Flexible permission system
- **Audit Logging** - Complete activity tracking with replay detection

### 👥 User Management
- User registration and login
- Profile management
- Role and permission assignment
- User activity tracking
- Password reset functionality

### 📊 Dashboard & Reporting
- Real-time metrics and KPIs
- Interactive charts and graphs
- Activity feeds
- Quick action buttons
- Customizable widgets

### 🏢 Business Modules (Structure Ready)
- **HR Management** - Employee records, attendance, payroll
- **Inventory Control** - Stock tracking, suppliers, products
- **Sales Management** - Orders, customers, invoicing
- **Accounting** - Ledger, expenses, financial reports

### 🎨 Modern UI/UX
- Responsive mobile-first design
- Beautiful login/registration pages
- Comprehensive landing page
- Professional admin interface
- Smooth animations and transitions
- Dark mode ready
- Accessible and user-friendly

### 📱 Responsive Design
- Mobile-optimized layouts
- Tablet-friendly interfaces
- Desktop-enhanced experience
- Touch-friendly controls

### ⚡ Performance
- Redis caching ready
- Database indexing optimized
- CSS minification
- Lazy loading prepared
- Efficient query patterns

---

## 🛠️ Tech Stack

### Backend
- **Language**: PHP 8.5+ (Native, no frameworks)
- **Database**: MySQL 5.7+ / MariaDB 10.3+
- **Cache**: Redis 5.0+ (optional)
- **Authentication**: JWT (JSON Web Tokens)
- **Password Hashing**: Argon2id

### Frontend
- **CSS Framework**: Tailwind CSS 4.1+
- **Icons**: Feather Icons
- **JavaScript**: Vanilla JS (ES6+)
- **Build Tool**: npm scripts

### Development Tools
- **Package Managers**: Composer 2.0+, npm 8+
- **Version Control**: Git
- **CLI Tools**: Custom migration and seeding scripts

---

## 📸 Screenshots

### 🏠 Landing Page
Modern, responsive homepage with hero section, features showcase, customer testimonials, and comprehensive call-to-action.

![PEANECH ERP Home Page](docs/screenshots/home-page.png)

**Key Features Shown:**
- Clean, professional navigation with logo and menu items (Home, About, Contact)
- Prominent CTAs: Green "Login" button and Blue "Get Started Now" button
- Hero section with gradient background and compelling headline
- Interactive dashboard preview showcasing real-time metrics
- Trust indicators: 10K+ Active Users, 99.9% Uptime, 24/7 Support
- Social proof section highlighting trusted companies

### 🔑 Login & Registration
Beautiful two-column authentication pages with social login options and email sign-in/sign-up.

### 📊 Admin Dashboard
Professional dashboard with metrics cards, charts, user management, and quick actions.

### 🎨 Modern UI Components
- Responsive navigation with mobile menu
- Professional footer with newsletter subscription
- Card-based layouts
- Form components with validation
- Modal dialogs
- Toast notifications

---

> **📝 Note**: To add actual screenshot images, save them in the `docs/screenshots/` directory. See [docs/screenshots/README.md](docs/screenshots/README.md) for guidelines on capturing and optimizing screenshots.

---

## 📦 Prerequisites

Before installation, ensure you have the following installed:

### Required
- **PHP** 8.5 or higher
- **MySQL** 5.7+ or MariaDB 10.3+
- **Composer** 2.0+
- **Node.js** 16+
- **npm** 8+

### Optional
- **Redis** 5.0+ (for caching)
- **Git** (for version control)

### Platform-Specific Setup

#### Windows
We recommend using **WSL2 (Windows Subsystem for Linux)** for the best development experience.

#### macOS
Install prerequisites via **Homebrew**:
```bash
brew install php composer mysql redis node
```

#### Linux (Ubuntu/Debian)
```bash
sudo apt update
sudo apt install php php-mysql php-redis composer nodejs npm mysql-server redis-server
```

---

## 🚀 Installation

### Step 1: Clone the Repository
```bash
git clone https://github.com/yourusername/peanech-erp.git
cd peanech-erp
```

### Step 2: Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### Step 3: Environment Configuration
```bash
# Copy environment example
cp .env.example .env

# Edit .env with your database credentials
nano .env  # or use your preferred editor
```

**Configure these variables in `.env`:**
```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=erp_system
DB_USER=your_username
DB_PASS=your_password

JWT_SECRET=your-secret-key-here
APP_KEY=your-app-encryption-key

REDIS_HOST=localhost
REDIS_PORT=6379
```

### Step 4: Create Database
```bash
# MySQL CLI
mysql -u root -p
CREATE DATABASE erp_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

Or use **phpMyAdmin**, **MySQL Workbench**, or any database management tool.

### Step 5: Run Migrations
```bash
# Create all database tables
php cli/migrate.php
```

### Step 6: Seed Sample Data
```bash
# Add sample users, roles, permissions, and data
php cli/seed.php
```

### Step 7: Build Assets
```bash
# Build Tailwind CSS
npm run build
```

### Step 8: Start Development Server
```bash
# Start PHP built-in server
php -S localhost:8000 -t public
```

---

## ⚡ Quick Start

After installation, you can immediately access the system:

1. **Visit Homepage**: http://localhost:8000
2. **Login**: http://localhost:8000/login
3. **Register**: http://localhost:8000/register
4. **Admin Dashboard**: http://localhost:8000/admin

### Default Credentials
```
Email: admin@example.com
Password: password
```

⚠️ **IMPORTANT**: Change the default password immediately after first login!

---

## 📁 Project Structure

```
erp-system-web/
├── app/                          # Application logic
│   ├── Controllers/              # Request handlers
│   │   └── AuthController.php    # Authentication controller
│   ├── Core/                     # Core system classes
│   │   ├── Auth.php              # Authentication helpers
│   │   ├── Database.php          # Database connection
│   │   ├── JwtService.php        # JWT token management
│   │   └── Security.php          # CSRF protection
│   ├── Repositories/             # Data access layer
│   │   └── UserRepository.php    # User data operations
│   ├── Services/                 # Business logic
│   │   ├── AuditService.php      # Audit logging
│   │   └── RefreshTokenService.php
│   └── routes.php                # Application routes
│
├── cli/                          # Command-line tools
│   ├── migrate.php               # Database migrations
│   ├── seed.php                  # Database seeding
│   └── sync_redis.php            # Redis synchronization
│
├── public/                       # Public web root
│   ├── css/                      # Compiled CSS
│   ├── js/                       # JavaScript files
│   └── index.php                 # Application entry point
│
├── resources/                    # Application resources
│   ├── views/                    # View templates
│   │   ├── admin/                # Admin pages
│   │   │   ├── dashboard.php     # Admin dashboard
│   │   │   ├── users.php         # User management
│   │   │   ├── settings.php      # System settings
│   │   │   ├── audits.php        # Audit log viewer
│   │   │   └── scheduled_exports/
│   │   ├── auth/                 # Authentication pages
│   │   │   ├── login.php         # Login page
│   │   │   └── register.php      # Registration page
│   │   ├── home/                 # Public pages
│   │   │   └── index.php         # Landing page
│   │   ├── layout/               # Layout templates
│   │   │   ├── admin_layout.php  # Admin layout
│   │   │   └── user_layout.php   # User/public layout
│   │   └── partials/             # Reusable components
│   │       └── csrf.php          # CSRF token field
│   └── css/                      # Source CSS
│       └── app.css               # Tailwind source
│
├── storage/                      # Application storage
│   └── logs/                     # Log files
│
├── docs/                         # Documentation assets
│   └── screenshots/              # README screenshots
│       ├── home-page.png         # Landing page screenshot
│       └── README.md             # Screenshot guidelines
│
├── .env.example                  # Environment template
├── composer.json                 # PHP dependencies
├── package.json                  # Node dependencies
├── tailwind.config.js            # Tailwind configuration
├── README.md                     # This file
├── INSTALLATION.md               # Detailed setup guide
├── ARCHITECTURE.md               # Technical architecture
├── PROJECT_SUMMARY.md            # Quick overview
├── DELIVERABLES.md               # Features checklist
└── QUICK_REFERENCE.txt           # Quick reference guide
```

---

## 🎮 Available Commands

### Development
```bash
# Start development server with CSS watch
npm run dev

# Start only PHP server
npm start

# Watch CSS files for changes
npm run css:watch

# Build CSS once
npm run css:build
```

### Database
```bash
# Run migrations (create tables)
php cli/migrate.php

# Seed sample data
php cli/seed.php

# Sync Redis cache
php cli/sync_redis.php
```

### Package Management
```bash
# Install PHP dependencies
composer install

# Update PHP dependencies
composer update

# Regenerate autoloader
composer dump-autoload -o

# Install Node dependencies
npm install

# Update Node dependencies
npm update
```

---

## ⚙️ Configuration

### Environment Variables

All configuration is managed through the `.env` file:

```env
# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_NAME=erp_system
DB_USER=root
DB_PASS=

# JWT Configuration
JWT_SECRET=your-super-secret-jwt-key-change-this-in-production
JWT_ACCESS_EXPIRY=900        # 15 minutes
JWT_REFRESH_EXPIRY=604800    # 7 days

# Application
APP_ENV=development          # development | production
APP_DEBUG=true              # true | false
APP_URL=http://localhost:8000
APP_KEY=your-encryption-key-for-sensitive-data

# Redis Configuration (Optional)
REDIS_HOST=localhost
REDIS_PORT=6379
REDIS_PASSWORD=
REDIS_DB=0

# Email Configuration (Future)
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=noreply@peanech.com
MAIL_FROM_NAME="PEANECH ERP"

# AWS S3 (For exports, optional)
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
```

### Tailwind Configuration

Customize Tailwind in `tailwind.config.js`:

```javascript
module.exports = {
  content: [
    "./resources/views/**/*.php",
    "./public/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#eff6ff',
          // ... customize colors
        },
      },
    },
  },
  plugins: [],
}
```

---

## 🔒 Security Features

### Authentication
- **JWT Tokens**: Stateless authentication with short-lived access tokens
- **Refresh Tokens**: Long-lived tokens with replay detection
- **Password Hashing**: Argon2id with configurable cost parameters
- **Token Revocation**: Blacklist support for compromised tokens

### Authorization
- **Role-Based Access Control (RBAC)**: Flexible permission system
- **Middleware Protection**: Route-level authentication enforcement
- **Permission Checks**: Granular access control

### Data Protection
- **CSRF Protection**: Global enforcement on all POST requests
- **SQL Injection Prevention**: PDO prepared statements throughout
- **XSS Prevention**: Proper output escaping
- **Input Validation**: Server-side validation on all inputs

### Audit & Compliance
- **Activity Logging**: Complete audit trail of user actions
- **IP Tracking**: User IP addresses logged
- **Data Change Tracking**: Before/after snapshots
- **Scheduled Exports**: Automated compliance reports

### Production Security
- **Environment-Based Config**: Sensitive data in .env
- **Secure Headers**: HTTPS, CSP, X-Frame-Options ready
- **Session Management**: Secure session configuration
- **Error Handling**: Production-safe error messages

---

## 🗄️ Database Schema

### Core Tables

#### users
User accounts and authentication
- `id`, `name`, `email`, `password`, `created_at`, `updated_at`

#### roles
User roles (admin, manager, user, etc.)
- `id`, `name`, `description`, `created_at`

#### permissions
System permissions
- `id`, `name`, `description`, `created_at`

#### role_user
User-role assignments (many-to-many)
- `user_id`, `role_id`

#### permission_role
Role-permission assignments (many-to-many)
- `role_id`, `permission_id`

#### refresh_tokens
JWT refresh token storage
- `id`, `user_id`, `token`, `expires_at`, `created_at`

#### audit_logs
System activity audit trail
- `id`, `action`, `user_id`, `model`, `model_id`, `before_data`, `after_data`, `ip`, `created_at`

#### settings
System settings with encryption support
- `key`, `value`, `encrypted`, `updated_at`

#### scheduled_exports
Automated export configurations
- `id`, `name`, `format`, `schedule`, `active`, `last_run_at`, `created_at`, `updated_at`

### Business Modules (Structure Ready)

#### HR Module
- **employees** - Employee records
- **attendance** - Attendance tracking
- **payroll** - Payroll processing

#### Inventory Module
- **products** - Product catalog
- **stock_movements** - Stock tracking
- **suppliers** - Supplier management

#### Sales Module
- **customers** - Customer database
- **sales_orders** - Order management
- **sales_items** - Order line items
- **invoices** - Invoice generation

#### Accounts Module
- **accounts** - Chart of accounts
- **ledger_entries** - General ledger
- **expenses** - Expense tracking

---

## 📡 API Documentation

### Authentication Endpoints

#### POST /api/login
Login and receive JWT tokens

**Request:**
```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "refresh_token": "random-secure-token",
  "token_type": "Bearer",
  "expires_in": 900
}
```

#### POST /api/refresh
Refresh access token using refresh token

**Request:**
```json
{
  "refresh_token": "your-refresh-token"
}
```

**Response:**
```json
{
  "access_token": "new-access-token",
  "token_type": "Bearer",
  "expires_in": 900
}
```

#### POST /api/logout
Revoke refresh token

**Request:**
```json
{
  "refresh_token": "your-refresh-token"
}
```

**Response:**
```json
{
  "revoked": true
}
```

### Protected Routes

All admin routes require authentication:
- `/admin` - Dashboard
- `/admin/users` - User management
- `/admin/settings` - System settings
- `/admin/audits` - Audit logs
- `/admin/scheduled_exports` - Export management

---

## 💻 Development

### Setting Up Development Environment

1. **Clone and Install**
```bash
git clone <repository>
cd erp-system-web
composer install
npm install
```

2. **Configure Environment**
```bash
cp .env.example .env
# Edit .env with your settings
```

3. **Setup Database**
```bash
php cli/migrate.php
php cli/seed.php
```

4. **Start Development**
```bash
npm run dev
```

### Coding Standards

- **PHP**: PSR-12 coding standard
- **CSS**: Tailwind utility-first approach
- **JavaScript**: ES6+ modern syntax
- **Comments**: PHPDoc for all functions
- **Naming**: Descriptive, self-documenting code

### Adding New Features

1. **Create Migration** (if database changes needed)
2. **Create Repository** (data access layer)
3. **Create Service** (business logic)
4. **Create Controller** (request handling)
5. **Create Views** (user interface)
6. **Add Routes** (in `app/routes.php`)
7. **Test Thoroughly**

### Database Migrations

Create new migration in `cli/migrate.php`:

```php
// Add to the migrations array
$migrations[] = "
CREATE TABLE IF NOT EXISTS example_table (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
";
```

---

## 🚀 Deployment

### Production Checklist

- [ ] Change default admin password
- [ ] Update `JWT_SECRET` and `APP_KEY` in .env
- [ ] Set `APP_ENV=production` and `APP_DEBUG=false`
- [ ] Configure proper database credentials
- [ ] Set up HTTPS/SSL certificates
- [ ] Configure web server (Apache/Nginx)
- [ ] Enable Redis caching
- [ ] Set up automated backups
- [ ] Configure error logging
- [ ] Set proper file permissions
- [ ] Enable firewall rules
- [ ] Configure email service
- [ ] Test all functionality

### Apache Configuration

Create `.htaccess` in `public/`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>
```

VirtualHost configuration:
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /path/to/erp-system-web/public
    
    <Directory /path/to/erp-system-web/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/erp-error.log
    CustomLog ${APACHE_LOG_DIR}/erp-access.log combined
</VirtualHost>
```

### Nginx Configuration

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/erp-system-web/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.5-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.ht {
        deny all;
    }
}
```

### Docker Deployment (Optional)

Example `docker-compose.yml`:

```yaml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "8000:8000"
    volumes:
      - .:/var/www/html
    environment:
      - DB_HOST=mysql
      - DB_NAME=erp_system
      - DB_USER=root
      - DB_PASS=secret
      
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: erp_system
    volumes:
      - mysql_data:/var/lib/mysql
      
  redis:
    image: redis:alpine
    
volumes:
  mysql_data:
```

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

### Reporting Bugs

1. Check if the bug has already been reported
2. Create a detailed issue with:
   - Steps to reproduce
   - Expected behavior
   - Actual behavior
   - Screenshots (if applicable)
   - Environment details

### Suggesting Features

1. Check if the feature has been requested
2. Create a detailed proposal with:
   - Use case description
   - Expected behavior
   - Implementation ideas (optional)

### Pull Requests

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Write/update tests
5. Update documentation
6. Submit pull request

### Code Review Process

1. Automated tests must pass
2. Code must follow PSR-12 standards
3. All functions must have PHPDoc
4. Security implications reviewed
5. At least one maintainer approval

---

## 📄 License

This project is licensed under the **MIT License**.

```
MIT License

Copyright (c) 2026 PEANECH ERP

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 📞 Support

### Documentation
- **Quick Start**: [START_HERE.md](START_HERE.md)
- **Installation**: [INSTALLATION.md](INSTALLATION.md)
- **Architecture**: [ARCHITECTURE.md](ARCHITECTURE.md)
- **Project Overview**: [PROJECT_SUMMARY.md](PROJECT_SUMMARY.md)
- **Quick Reference**: [QUICK_REFERENCE.txt](QUICK_REFERENCE.txt)

### Getting Help

- **Issues**: [GitHub Issues](https://github.com/yourusername/peanech-erp/issues)
- **Discussions**: [GitHub Discussions](https://github.com/yourusername/peanech-erp/discussions)
- **Email**: support@peanech.com

### Common Issues

See [INSTALLATION.md](INSTALLATION.md) → Troubleshooting section for:
- Database connection errors
- Permission issues
- Migration problems
- CSS build errors
- Server configuration

---

## 🙏 Acknowledgments

- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Feather Icons](https://feathericons.com) - Beautiful icon set
- [PHP](https://php.net) - Server-side scripting language
- [MySQL](https://mysql.com) - Relational database system

---

## 📊 Project Stats

- **Total Files**: 50+
- **Lines of Code**: 5,000+
- **Documentation**: 2,000+ lines
- **Database Tables**: 19
- **Languages**: PHP, JavaScript, CSS
- **Development Time**: Professional-grade implementation

---

## 🎯 Roadmap

### Current Features ✅
- User authentication & authorization
- Admin dashboard
- Modern responsive UI
- Database structure
- Audit logging
- Scheduled exports

### Upcoming Features 🚧
- [ ] Email notifications
- [ ] Advanced reporting
- [ ] Data export (Excel, PDF)
- [ ] Mobile app
- [ ] Real-time notifications
- [ ] Multi-language support
- [ ] Dark mode
- [ ] API rate limiting
- [ ] Two-factor authentication

### Future Enhancements 💡
- Analytics dashboard
- Automated backups
- Advanced search
- Bulk operations
- Workflow automation
- Integration APIs
- Custom theming
- Plugin system

---

<div align="center">

**Made with ❤️ by the PEANECH Team**

[⬆ Back to Top](#-peanech-erp---enterprise-resource-planning-system)

</div>
