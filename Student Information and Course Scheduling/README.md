# UNILINK - Student Information and Course Scheduling

A modern and efficient subsystem of a larger academic platform, designed to streamline student information management and administrative processes.

![UNILINK Logo](unilink_logo.png)

## Features

- **Secure Authentication System**

  - Role-based access control (Admin/Student)
  - Encrypted password protection
  - Session management

- **Student Portal**

  - Personal information management
  - Academic record viewing
  - Course registration
  - Document requests

- **Administrative Dashboard**
  - Student records management
  - Course management
  - Academic data administration
  - System monitoring

## Tech Stack

- **Frontend**

  - HTML5
  - CSS3 (Bootstrap 5.2.0)
  - JavaScript
  - Font Awesome 6.1.1

- **Backend**
  - PHP
  - MySQL Database

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern web browser

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Khadalicioso/unilink_student_information_system.git
   ```

2. Configure your web server to point to the project directory

3. Import the database:

   - Create a new MySQL database
   - Import the SQL file from the `data` directory

4. Configure database connection:

   - Update the credentials in `DB_connection.php`

5. Access the system through your web browser

## Security

- Implements secure password hashing
- Protected against SQL injection
- Session-based authentication
- Input validation and sanitization

## Project Structure

```
unilink_student_information_system/
├── admin/           # Administrative interface
├── Student/         # Student portal
├── css/            # Stylesheets
├── js/             # JavaScript files
├── inc/            # Include files
├── req/            # Request handlers
└── data/           # Database files
```

## User Roles

1. **Administrator**

   - Full system access
   - User management
   - System configuration

2. **Student**
   - Personal profile management
   - Academic information access
   - Document requests

## License

This project is licensed under the terms of the MIT License.
