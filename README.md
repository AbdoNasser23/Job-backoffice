# JobBoard Backoffice

<p align="center">
  <strong>Administrative & Company Management System</strong>
</p>

<p align="center">
  A centralized backoffice application for managing job vacancies, companies, applications, users, and platform operations.
</p>

<p align="center">
  ![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=flat-square&logo=php&logoColor=white)
  ![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white)
  ![MariaDB](https://img.shields.io/badge/MariaDB-Database-003545?style=flat-square&logo=mariadb&logoColor=white)
  ![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-UI-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
  ![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)
</p>

---

## Overview

**JobBoard Backoffice** is the administrative management system of the JobBoard platform, built with Laravel.

It provides a dedicated environment for administrators and company owners to manage their operations, maintain platform data, and oversee recruitment activities.

The application is designed to provide role-based access, organized management workflows, and a centralized interface for handling the core resources of the job board platform.

## Key Features

### 1. Dashboard
- Centralized dashboard for platform management.
- Overview of important application data.
- Dedicated management interface for authorized users.

### 2. Job Vacancy Management
- Create and manage job vacancies.
- Update vacancy information.
- Manage vacancy categories and job types.
- Archive vacancies instead of permanently deleting them.
- Track vacancy application statistics.

### 3. Company Management
- Manage registered companies.
- Maintain company profiles and information.
- Associate companies with their respective owners.
- Control company access to their resources.

### 4. Application Management
- View job applications.
- Review applicant information.
- Access submitted CVs.
- Review AI-generated scores and feedback.
- Sort applications according to their evaluation scores.

### 5. User Management
- Manage platform users.
- Control access based on user roles.
- Separate administrative permissions from company-owner permissions.

### 6. Authorization & Security
- Laravel Gates and authorization policies.
- Role-based access control.
- Company owners can only manage resources associated with their companies.
- Protected administrative operations.

## Architecture

JobBoard Backoffice is part of a larger ecosystem consisting of three interconnected components:

```text
                 JobBoard Platform
                         |
          +--------------+--------------+
          |              |              |
      JobBoard App   Job Backoffice  Job Shared
          |              |              |
          +--------------+--------------+
                         |
                  Shared Database
                    Components
```

### Related Repositories

| Repository | Description |
|---|---|
| [JobBoard App](https://github.com/AbdoNasser23/Job-Board-platform) | Main job board application |
| [Job Backoffice](https://github.com/AbdoNasser23/Job-backoffice) | Administrative and company management |
| [Job Shared](https://github.com/AbdoNasser23/Job-shared) | Shared models and database components |

The `Job Shared` package provides common models and database components used by both applications, helping maintain consistency and reduce duplicated code.

## Technology Stack

| Technology | Purpose |
|---|---|
| PHP 8.3+ | Backend development |
| Laravel 13 | Application framework |
| MySQL / MariaDB | Relational database |
| Eloquent ORM | Database interactions |
| Laravel Gates & Policies | Authorization |
| Blade | Server-side templating |
| Tailwind CSS | User interface styling |
| JavaScript | Frontend interactions |
| Composer | PHP dependency management |
| Vite & NPM | Frontend asset management |

## Requirements

Before running the project, make sure you have:

- PHP 8.3 or higher.
- Composer.
- Node.js and NPM.
- MySQL or MariaDB.
- Git.

## Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/AbdoNasser23/Job-backoffice.git
```

```bash
cd Job-backoffice
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Configure environment

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the database

Create a database and update the following values in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shaghal_db
DB_USERNAME=root
DB_PASSWORD=
```

Update the credentials according to your local database configuration.

### 5. Configure the shared package

The project uses the `job/shared` Composer package.

The local development configuration expects the shared repository to be located alongside the backoffice directory:

```text
Job_board/
│
├── Job_backoffice/
│
└── Job_shared/
```

Make sure the shared package is available at the configured path before running Composer installation.

Repository: https://github.com/AbdoNasser23/Job-shared

### 6. Run database migrations

```bash
php artisan migrate
```

### 7. Install frontend dependencies

```bash
npm install
```

Build the frontend assets:

```bash
npm run build
```

### 8. Start the development server

```bash
php artisan serve
```

Open the application at:

http://127.0.0.1:8000

## Running Tests

Run the application test suite using:

```bash
php artisan test
```

## Project Goals

JobBoard Backoffice aims to provide:

- Efficient recruitment platform management.
- Secure separation of administrative responsibilities.
- Organized company and vacancy management.
- Centralized application evaluation.
- Consistent data structures across multiple applications.
- Maintainable and scalable backend architecture.

## Future Improvements

Potential areas for future development include:

- Advanced dashboard analytics.
- More detailed recruitment reports.
- Enhanced application filtering.
- Expanded administrative monitoring tools.
- Additional automation for recruitment workflows.

## License

This project is licensed under the MIT License.

---

<p align="center">
  <strong>JobBoard Backoffice</strong>
  <br/>
  Manage. Monitor. Organize.
  <br/>
  <sub>Part of the JobBoard Platform ecosystem.</sub>
</p>
