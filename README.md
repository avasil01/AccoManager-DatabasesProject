# AccoManager

AccoManager is a web-based Accommodation Booking and Management System developed using PHP and MySQL. The system supports both users and administrators by providing a complete workflow for managing accommodations, room types, services, and bookings within a structured relational database environment.

---

## Overview

The platform allows users to create accounts, log in securely, browse available accommodations, view room type details, and manage bookings. Users can make reservations, view their booking history, and cancel bookings when needed.

Administrators have access to a dedicated dashboard where they can manage accommodations, room types, services, and users. The system implements full CRUD (Create, Read, Update, Delete) operations across multiple database entities.

---

## Key Features

### User Functionality
- User registration and authentication
- Browse accommodations
- View detailed accommodation and room type information
- Book accommodations
- View booking history
- Cancel bookings

### Admin Functionality
- Add and modify accommodations
- Manage room types
- Manage additional services
- View and manage users
- Centralized administrative dashboard

---

## Technical Stack

**Backend**
- PHP

**Database**
- MySQL

**Frontend**
- HTML
- CSS

**Architecture**
- Server-side rendered PHP application
- Modular structure separating authentication, booking, and admin logic
- Database connection configured through a dedicated file

---

## System Design

The system follows a server-side architecture where PHP handles business logic, session management, and database interaction. MySQL manages persistent storage through relational tables that support booking workflows and entity relationships.

The application demonstrates structured backend development, database-driven design, role-based access control, and end-to-end booking management functionality.

---

## How to Run the Project

### Requirements
- XAMPP / WAMP / MAMP (Apache + MySQL)
- PHP 7+
- MySQL

### Setup Instructions

1. Clone the repository:
   git clone https://github.com/yourusername/AccoManager.git


2. Move the project folder into your local server directory:
- XAMPP → `htdocs`
- WAMP → `www`
- MAMP → `htdocs`

3. Start Apache and MySQL from your control panel.

4. Create a new MySQL database (e.g., `accomanager`).

5. Import the database schema (if provided) using phpMyAdmin.

6. Open the `db.php` file and update the database credentials:
- Host
- Username
- Password
- Database name

7. Open your browser and navigate to:
   http://localhost/AccoManager


The system should now be running locally.

---

## Future Improvements

- Password hashing and improved authentication security
- Use of prepared statements for enhanced database security
- Improved input validation
- REST API refactoring
- Frontend modernization using a modern framework
- Cloud deployment for scalability
