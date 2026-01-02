# Payroll Management System

![PayrollPro](https://img.shields.io/badge/PayrollPro-v1.0-blue?style=for-the-badge)
![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-green?style=for-the-badge&logo=vue.js)
![License](https://img.shields.io/badge/License-Proprietary-red?style=for-the-badge)

A modern, professional payroll management system built with Laravel and Vue.js. This comprehensive solution streamlines employee management, attendance tracking, payroll processing, and payslip generation for businesses of all sizes.

## Table of Contents

- [License & Terms](#license--terms)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Troubleshooting](#troubleshooting)
- [Security](#security)
- [Support](#support)

## License & Terms

**PROPRIETARY SOFTWARE** - This software is protected by copyright law.

### What You CAN Do:
- ✅ Use this software for your own business operations
- ✅ Modify it for your internal business needs
- ✅ Customize features and styling for personal use

### What You CANNOT Do:
- ❌ Redistribute, resell, or sublicense the software
- ❌ Remove copyright notices, watermarks, or attributions
- ❌ Use it to create competing products or services
- ❌ Share or distribute modified versions
- ❌ Rebrand it as your own product

See [LICENSE](LICENSE) file for complete terms and conditions.

---

## About This System

The Payroll Management System is a full-stack web application designed to automate and simplify payroll operations. Built with modern technologies and following best practices, it provides a robust solution for managing your workforce efficiently.

### Key Benefits:
- **Fast & Efficient** - Optimized performance with response times under 150ms
- **Modern UI/UX** - Professional design with dark mode support
- **Secure** - Built-in authentication and authorization
- **Responsive** - Works seamlessly on desktop, tablet, and mobile
- **Real-time Updates** - Powered by Inertia.js for SPA-like experience

## Features

### Employee Management
- Complete employee records with personal information
- Employee ID generation and tracking
- Position and department management
- Base salary configuration
- Employee status tracking (active/inactive)
- CRUD operations (Create, Read, Update, Delete)

### Attendance Tracking
- Daily attendance logging
- Clock in/out time recording
- Work hours calculation
- Overtime tracking
- Absence management
- Attendance reports and analytics

### Payroll Processing
- Automated salary calculations
- Allowances management (housing, transport, meal, etc.)
- Deductions handling (tax, insurance, loans, etc.)
- Gross and net salary computation
- Payroll period management
- Bulk payroll processing

### Payslip Generation
- Professional payslip templates
- PDF export functionality
- Detailed salary breakdown
- Allowances and deductions itemization
- Employee and company information
- Digital distribution

### User Interface
- Gradient-based modern design
- Intuitive navigation system
- Card-based layouts
- Icon-enhanced interface
- Smooth animations and transitions
- Professional color scheme (blue/indigo primary)

## Technology Stack

### Backend
- **Framework**: Laravel 12.x
- **Language**: PHP 8.2
- **Authentication**: Laravel Fortify
- **ORM**: Eloquent
- **Session**: Database sessions

### Frontend
- **Framework**: Vue.js 3 (Composition API)
- **Bridge**: Inertia.js 2.0
- **Build Tool**: Vite 7.3
- **Styling**: Tailwind CSS 4.1
- **Icons**: Heroicons (SVG)

### Database
- **RDBMS**: MySQL 8.0
- **Containerization**: Docker
- **Port**: 3306 (localhost)

### Development Tools
- **Version Control**: Git
- **Package Manager**: Composer (PHP), NPM (JavaScript)
- **Code Quality**: Laravel Pint, ESLint

## System Requirements

### Minimum Requirements
- **PHP**: 8.2 or higher
- **Composer**: 2.x
- **Node.js**: 18.x or higher
- **NPM**: 9.x or higher
- **MySQL**: 8.0 or higher
- **Docker**: 20.x or higher (for MySQL container)

### Recommended Server Specs
- **RAM**: 4GB minimum, 8GB recommended
- **Storage**: 10GB free space
- **CPU**: 2 cores minimum, 4 cores recommended

## Installation

### Step 1: Clone the Repository
```bash
git clone https://github.com/heneral/payroll-management-system.git
cd payroll-management-system
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install JavaScript Dependencies
```bash
npm install
```

### Step 4: Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 5: Start MySQL Container
```bash
# Start the MySQL Docker container
docker start payroll-mysql

# Verify container is running
docker ps | grep payroll-mysql
```

### Step 6: Run Database Migrations
```bash
# Create database tables
php artisan migrate

# Seed sample data (optional)
php artisan db:seed
```

### Step 7: Build Frontend Assets
```bash
# Development build
npm run dev

# Production build
npm run build
```

### Step 8: Start Development Server
```bash
# Start Laravel server
php artisan serve

# Server will be available at: http://127.0.0.1:8000
```

## Configuration

### Database Configuration (.env)
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=payroll_system
DB_USERNAME=root
DB_PASSWORD=secret
```

### Application Settings
```env
APP_NAME="Payroll Management System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

### Session Configuration
```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

## Database Setup

### Docker MySQL Container
The system uses MySQL running in a Docker container named `payroll-mysql`.

#### Container Details:
- **Container Name**: payroll-mysql
- **Image**: mysql:8.0
- **Port Mapping**: 0.0.0.0:3306->3306/tcp
- **Database**: payroll_system
- **Username**: root
- **Password**: secret

#### Starting the Container:
```bash
docker start payroll-mysql
```

#### Stopping the Container:
```bash
docker stop payroll-mysql
```

#### Checking Container Status:
```bash
docker ps -a | grep payroll-mysql
```

### Database Schema
The system includes 9 main tables:
1. **users** - User authentication and accounts
2. **employees** - Employee master data
3. **attendances** - Attendance records
4. **payrolls** - Payroll processing data
5. **allowances** - Employee allowances
6. **deductions** - Employee deductions
7. **payslips** - Generated payslips
8. **sessions** - User session management
9. **cache** - Application cache

### Sample Data
The seeder creates 5 sample employees:
- EMP001: John Doe (Manager)
- EMP002: Jane Smith (Developer)
- EMP003: Michael Johnson (Designer)
- EMP004: Sarah Williams (Accountant)
- EMP005: David Brown (HR Specialist)

## Usage

### Accessing the Application
1. **Welcome Page**: http://127.0.0.1:8000
2. **Login**: http://127.0.0.1:8000/login
3. **Register**: http://127.0.0.1:8000/register
4. **Dashboard**: http://127.0.0.1:8000/dashboard (after login)

### Main Navigation
- **Dashboard** - Overview and statistics
- **Employees** - Manage employee records
- **Attendance** - Track attendance
- **Payroll** - Process payroll
- **Payslips** - Generate and view payslips

### Common Tasks

#### Adding a New Employee
1. Navigate to **Employees** page
2. Click **Add Employee** button
3. Fill in employee details (name, email, phone, position, salary)
4. Click **Save** to create the employee record

#### Recording Attendance
1. Navigate to **Attendance** page
2. Click **Add Attendance** button
3. Select employee and date
4. Enter clock-in and clock-out times
5. System calculates work hours automatically

#### Processing Payroll
1. Navigate to **Payroll** page
2. Click **Create Payroll** button
3. Select employee and pay period
4. Add allowances (housing, transport, meal, etc.)
5. Add deductions (tax, insurance, loans, etc.)
6. System calculates gross and net salary
7. Save payroll record

#### Generating Payslips
1. Navigate to **Payslips** page
2. Click **Generate Payslip** button
3. Select payroll record
4. System creates formatted payslip
5. Download as PDF or view online

## Project Structure

```
payroll-management-system/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Application controllers
│   │   │   ├── EmployeeController.php
│   │   │   ├── AttendanceController.php
│   │   │   ├── PayrollController.php
│   │   │   └── PayslipController.php
│   │   └── Middleware/         # Custom middleware
│   │       └── HandleInertiaRequests.php
│   └── Models/                 # Eloquent models
│       ├── Employee.php
│       ├── Attendance.php
│       ├── Payroll.php
│       ├── Allowance.php
│       ├── Deduction.php
│       └── Payslip.php
├── database/
│   ├── migrations/             # Database migrations
│   └── seeders/                # Database seeders
│       └── DatabaseSeeder.php
├── resources/
│   ├── js/
│   │   ├── Pages/              # Vue.js pages
│   │   │   ├── Welcome.vue
│   │   │   ├── Dashboard.vue
│   │   │   ├── Employees/
│   │   │   │   ├── Index.vue
│   │   │   │   ├── Form.vue
│   │   │   │   └── Show.vue
│   │   │   ├── Attendance/
│   │   │   ├── Payroll/
│   │   │   └── Payslips/
│   │   ├── Layouts/            # Layout components
│   │   │   └── AppLayout.vue
│   │   └── app.js              # Main JavaScript file
│   └── css/
│       └── app.css             # Main stylesheet
├── routes/
│   └── web.php                 # Web routes
├── .env                        # Environment configuration
├── composer.json               # PHP dependencies
├── package.json                # JavaScript dependencies
├── tailwind.config.js          # Tailwind CSS configuration
├── vite.config.js              # Vite build configuration
├── LICENSE                     # License file
└── README.md                   # This file
```

## API Endpoints

### Employee Management
- `GET /employees` - List all employees
- `GET /employees/create` - Show employee creation form
- `POST /employees` - Store new employee
- `GET /employees/{id}` - Show employee details
- `GET /employees/{id}/edit` - Show employee edit form
- `PUT /employees/{id}` - Update employee
- `DELETE /employees/{id}` - Delete employee

### Attendance Management
- `GET /attendance` - List all attendance records
- `POST /attendance` - Store new attendance record
- `PUT /attendance/{id}` - Update attendance record
- `DELETE /attendance/{id}` - Delete attendance record

### Payroll Management
- `GET /payroll` - List all payroll records
- `POST /payroll` - Create new payroll
- `GET /payroll/{id}` - Show payroll details
- `PUT /payroll/{id}` - Update payroll
- `DELETE /payroll/{id}` - Delete payroll

### Payslip Management
- `GET /payslips` - List all payslips
- `POST /payslips` - Generate new payslip
- `GET /payslips/{id}` - View payslip details
- `GET /payslips/{id}/download` - Download payslip as PDF

## Troubleshooting

### Common Issues and Solutions

#### Issue: "Connection refused" when accessing employees page
**Cause**: MySQL Docker container is stopped
**Solution**:
```bash
docker start payroll-mysql
docker ps | grep payroll-mysql
```

#### Issue: Slow page loading (500ms+)
**Cause**: Using `.toArray()` on Eloquent collections
**Solution**: Remove `.toArray()` calls in controllers, let Inertia handle serialization

#### Issue: Session hanging/timeout
**Cause**: Accessing `$request->user()` in middleware
**Solution**: Return null for user in HandleInertiaRequests middleware

#### Issue: Frontend not updating after changes
**Solution**:
```bash
npm run build
# Clear browser cache or hard refresh (Ctrl+Shift+R)
```

#### Issue: Database migration errors
**Solution**:
```bash
# Reset database (WARNING: Deletes all data)
php artisan migrate:fresh --seed
```

#### Issue: Permission denied errors
**Solution**:
```bash
# Fix Laravel storage permissions
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

### Performance Optimization

#### Check Response Times
```bash
# Monitor server logs for timing
ps aux | grep "php artisan serve"
```

Expected response times:
- Dashboard: ~0.10ms
- Employees: ~0.11ms
- Attendance: ~0.10ms
- Payroll: ~0.11ms
- Payslips: ~0.11ms

#### Optimize Database Queries
```php
// Use select() to limit columns
Employee::select('id', 'first_name', 'last_name', 'position')->get();

// Avoid N+1 queries with eager loading
Payroll::with(['employee', 'allowances', 'deductions'])->get();
```

## Security

### Authentication
- Laravel Fortify for authentication
- Database-backed sessions
- Password hashing with bcrypt
- CSRF protection on all forms

### Authorization
- Middleware-based route protection
- User authentication required for dashboard access
- Session timeout after 120 minutes

### Best Practices
- Never commit `.env` file to version control
- Keep dependencies updated regularly
- Use strong passwords for database users
- Enable HTTPS in production
- Implement rate limiting for API endpoints

### Security Vulnerabilities
If you discover a security vulnerability, please contact the development team immediately. Do not disclose security issues publicly.

## Support

### Getting Help
- Review this documentation thoroughly
- Check the [Troubleshooting](#-troubleshooting) section
- Verify all system requirements are met
- Ensure Docker container is running

### Resources
- Laravel Documentation: https://laravel.com/docs
- Vue.js Documentation: https://vuejs.org/guide
- Inertia.js Documentation: https://inertiajs.com
- Tailwind CSS Documentation: https://tailwindcss.com/docs

### Development Team
For licensing inquiries, support, or custom development:
- **Project**: Payroll Management System
- **Version**: 1.0
- **Copyright**: © 2026 PayrollPro

---

## Changelog

### Version 1.0 (January 2026)
- Initial release
- Employee management module
- Attendance tracking system
- Payroll processing engine
- Payslip generation feature
- Modern UI/UX with dark mode
- Responsive design implementation
- Docker MySQL integration
- Performance optimization (sub-150ms response times)

---

## Acknowledgments

This project is built with amazing open-source technologies:

- **Laravel** - The PHP framework for web artisans
- **Vue.js** - The progressive JavaScript framework
- **Inertia.js** - Modern monolith bridge
- **Tailwind CSS** - Utility-first CSS framework
- **Heroicons** - Beautiful hand-crafted SVG icons

---

**© 2026 PayrollPro. All Rights Reserved. Proprietary Software.**

*Unauthorized reproduction, distribution, or use is strictly prohibited and may result in severe civil and criminal penalties.*

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
