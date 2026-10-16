# BUHUAN
### Online Barangay Service Management System for Barangay Buhuan

BUHUAN is an online barangay service management system developed to digitalize and streamline barangay services for Barangay Buhuan. It provides a centralized platform where residents can access barangay services online, while barangay administrators can manage requests, appointments, resident accounts, and administrative transactions more efficiently.

The system aims to reduce manual processes, improve the organization of barangay records, and provide residents with a more convenient way to access essential services.

## Project Overview

Traditional barangay transactions often require residents to visit the barangay office for document requests, inquiries, and appointments. Manual processing may also make it difficult to organize requests and monitor their progress.

BUHUAN addresses these challenges by providing an online platform that supports digital transactions between residents and barangay personnel.

Through the system, residents can submit requests and monitor their status, while administrators can review submissions, manage requests, and maintain organized records.

## Objectives

The BUHUAN system aims to:

- Improve accessibility to barangay services.
- Simplify document requesting and appointment scheduling.
- Reduce reliance on manual and paper-based transactions.
- Provide organized management of resident accounts and requests.
- Improve communication between residents and barangay administrators.
- Support more efficient and transparent barangay service delivery.

## Intended Users

### Residents

Residents can create accounts, access available services, submit requests, schedule appointments, and monitor the status of their transactions.

### Barangay Administrators

Authorized barangay personnel can manage resident accounts, review and process document requests, organize appointments, and oversee barangay service transactions.

## System Features

### Resident Portal

- **Account Registration and Login** – Allows residents to create accounts and securely access the system.
- **Account Verification** – Supports verification and approval of resident accounts.
- **Document Requests** – Allows residents to submit barangay document requests online.
- **Request Tracking** – Enables residents to monitor the progress and status of their requests.
- **Appointment Scheduling** – Allows residents to schedule appointments for available barangay services.
- **Notifications** – Provides updates related to system transactions.

### Administrator Portal

- **Resident Verification and Approval** – Reviews and approves resident account registrations.
- **User Management** – Manages registered system users.
- **Document Request Management** – Reviews, processes, and updates document requests.
- **Appointment Management** – Organizes and manages resident appointments.
- **Concerns and Meetings Management** – Supports the organization of barangay concerns and meetings.
- **Records and Reports** – Provides access to administrative records and available reporting functions.

## How the System Works

### For Residents

1. Visit the BUHUAN website.
2. Register a resident account.
3. Complete the required verification and approval process.
4. Log in to the resident portal.
5. Select an available barangay service.
6. Submit a document request or schedule an appointment.
7. Monitor the status of the submitted transaction.

### For Administrators

1. Log in using an authorized administrator account.
2. Review pending resident account registrations.
3. Verify and approve eligible accounts.
4. Review incoming document requests and appointments.
5. Process requests and update their statuses.
6. Manage available barangay records and administrative transactions.

## Technologies Used

| Technology | Purpose |
|---|---|
| Laravel (PHP) | Backend framework and application logic |
| MySQL | Database management |
| Blade Templates | Server-side interface rendering |
| HTML | Webpage structure |
| CSS | Interface styling |
| JavaScript | Interactive interface functionality |
| Vite | Frontend asset development and bundling |

## System Requirements

Before installing BUHUAN, ensure that the following are available:

- PHP compatible with the project's Laravel version
- Composer
- Node.js and npm
- MySQL
- XAMPP or an equivalent local database server
- Visual Studio Code or another code editor (optional)
- A modern web browser

## How to Download BUHUAN

### Option 1: Download ZIP

1. Open the BUHUAN GitHub repository.
2. Click the green **Code** button.
3. Select **Download ZIP**.
4. Extract the downloaded ZIP file.
5. Open the extracted project folder.

### Option 2: Clone Using Git

Open a terminal and run:

```bash
git clone https://github.com/PauleneCuraming/BUHUAN-.git
cd BUHUAN-
```

## Installation Guide

### Step 1: Install Dependencies

Open a terminal inside the BUHUAN project folder and run:

```bash
composer install
npm install
```

### Step 2: Configure Environment

Create a `.env` file from `.env.example`.

For Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

### Step 3: Configure the Database

1. Open XAMPP Control Panel.
2. Start MySQL.
3. Open `http://localhost/phpmyadmin`.
4. Create a new database named `buhuan_db`.
5. Open the `.env` file and update the database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=buhuan_db
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the credentials according to your local MySQL configuration.

### Step 4: Create Database Tables

Run:

```bash
php artisan migrate
```

If the project includes complete seeders for required initial data, run:

```bash
php artisan db:seed
```

The migration and seeding process must be verified against the actual project before use.

### Step 5: Configure Storage

```bash
php artisan storage:link
```

### Step 6: Run BUHUAN

Start the Laravel development server:

```bash
php artisan serve
```

Open another terminal and run:

```bash
npm run dev
```

### Step 7: Access the System

Open a browser and visit:

http://127.0.0.1:8000

The BUHUAN application should load if all dependencies and configuration requirements have been satisfied.

## Account Setup

### Resident Account

Residents can register through the system's registration page and follow the existing verification and approval process before accessing applicable services.

### Administrator Account

Administrator accounts require secure initial configuration. The installer must follow the project's supported administrator setup procedure.

Never publish production administrator passwords or real user credentials in this repository.

## Important Notes

- BUHUAN requires a properly configured MySQL database.
- Database migrations must include all tables required by the application.
- Required reference data and initial accounts may need additional setup.
- Email-based functionality may require mail service configuration.
- The actual `.env` file, private resident information, and identification documents must not be uploaded.
- Installation instructions should be tested using a fresh database before distribution.
- Running the project locally is different from deploying it to a publicly accessible website.

## Project Purpose

BUHUAN was developed to support the digital transformation of barangay services by making common transactions more accessible, organized, and efficient.

The system serves as a supplementary digital platform for residents and barangay personnel, helping improve service delivery, transaction monitoring, and administrative management.

## Project Repository

**GitHub:** https://github.com/PauleneCuraming/BUHUAN-

The repository contains the source code and setup instructions for downloading and installing BUHUAN.
