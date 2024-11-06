# School Management System

This project is a **School Management System** built with **Laravel**. It provides role-based dashboards for various user types—admins, teachers, students, and parents—and includes key features like user management, class assignments, subject management, and more.

## Features

- **Role-Based Access**: Different dashboards and functionalities for admins, teachers, students, and parents.
- **User Management**: Soft deletes, custom filters, and dynamic form selections.
- **Class and Subject Management**: CRUD operations for classes and subjects, with pivot table association.
- **Status and Type Enum**: Dynamic management of statuses and types for classes and subjects.
- **Pagination**: Custom pagination for listing various entities.

## Getting Started

### Prerequisites

- PHP 8+
- Composer
- Laravel 10+
- MySQL

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/school-management-system.git
   cd school-management-system

2. **Install dependencies**:
   ```bash
   composer install
   npm install && npm run dev

3. **Configure environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate

4. **Migrate and seed the database**:
   ```bash
    php artisan migrate --seed

5. **Serve the application**:
    ```bash
    php artisan serve

### Additional Setup
- **Roles and Permissions**: Ensure seeding sets up roles for admin, teacher, parent, and student.
- **Enum Setup**: For dynamic dropdowns in forms, enums for class statuses and subject types should be configured.

## Folder Structure
- **Controllers**: Handles business logic for each module.
- **Models**: Defines data structure and relationships.
- **Views**: Contains Blade templates for each dashboard.
- **Routes**: Defined in web.php, organized by user role.

## Usage
- **Admin Panel**: Admins can manage users, classes, subjects, and assign users to roles.
- **Teacher Dashboard**: View assigned classes, manage student progress.
- **Student Dashboard**: Access assigned classes and grades.
- **Parent Dashboard**: View child’s classes, grades, and activities.

## Contributing
- Feel free to submit pull requests for new features or fixes! 
