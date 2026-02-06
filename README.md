# Course Registration System - Database Learning Project

A MySQL database learning project built with Laravel framework to practice and demonstrate fundamental database concepts, SQL commands, and relational database design.

## 📚 Project Overview

This project was created as an educational tool for learning database management using MySQL commands. It implements a university course registration system with proper relational design, demonstrating key database concepts including:

- Table creation and schema design
- Primary and foreign key constraints
- Relationships (One-to-Many, Many-to-Many)
- ENUM data types
- Unique constraints
- Cascade operations
- Timestamps and auto-updates

## 🗄️ Database Schema

The system consists of five main tables:

### 1. **Departments**
- `dept_id` - Primary Key (Auto Increment)
- `dept_name` - Unique department name
- `location` - Department location
- Timestamps

### 2. **Instructors**
- `instructor_id` - Primary Key (Auto Increment)
- `name` - Instructor name
- `email` - Unique email address
- `dept_id` - Foreign Key to Departments (CASCADE)
- Timestamps

### 3. **Courses**
- `course_id` - Primary Key (VARCHAR)
- `title` - Course title
- `credits` - Course credits (DECIMAL)
- `dept_id` - Foreign Key to Departments (CASCADE)
- `instructor_id` - Foreign Key to Instructors (SET NULL)
- Timestamps

### 4. **Students**
- `student_id` - Primary Key (Auto Increment)
- `name` - Student name
- `email` - Unique email address
- `major` - Student's major
- `year` - Academic year (ENUM: "1", "2", "3", "4", "Graduate")
- Timestamps

### 5. **Registrations**
- `reg_id` - Primary Key (Auto Increment)
- `student_id` - Foreign Key to Students (CASCADE)
- `course_id` - Foreign Key to Courses (CASCADE)
- `semester` - Registration semester
- `grade` - Course grade
- `registered_at` - Registration timestamp
- Unique constraint on (student_id, course_id, semester)
- Timestamps

## 🔗 Relationships

- **Department → Instructors**: One-to-Many
- **Department → Courses**: One-to-Many
- **Instructor → Courses**: One-to-Many
- **Student → Registrations**: One-to-Many
- **Course → Registrations**: One-to-Many
- **Students ↔ Courses**: Many-to-Many (through Registrations)

## 🛠️ Technologies Used

- **Framework**: Laravel 11.x
- **Database**: MySQL
- **Language**: PHP 8.2+
- **SQL**: Raw MySQL commands via `DB::statement()`

## 📋 Prerequisites

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM (for assets)

## ⚙️ Installation & Setup

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd course-registration
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Update database configuration in `.env`**
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=course_registration
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Create the database**
   ```sql
   CREATE DATABASE course_registration;
   ```

7. **Run migrations**
   ```bash
   php artisan migrate
   ```

8. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

## 🚀 Usage

### Running the Application

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

### Database Operations

The migrations use raw SQL commands for educational purposes:

```php
// Example: Creating departments table
DB::statement('
    CREATE TABLE departments(
        dept_id int auto_increment primary key,
        dept_name varchar(100) not null unique,
        location varchar(150),
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );
');
```

### Resetting the Database

```bash
php artisan migrate:fresh --seed
```

## 🎯 Key Learning Concepts Demonstrated

1. **DDL (Data Definition Language)**
   - CREATE TABLE
   - ALTER TABLE
   - DROP TABLE
   - Primary Keys
   - Foreign Keys
   - Constraints

2. **Data Types**
   - INT, VARCHAR, DECIMAL
   - ENUM
   - TIMESTAMP
   - AUTO_INCREMENT

3. **Constraints**
   - PRIMARY KEY
   - FOREIGN KEY
   - UNIQUE
   - NOT NULL
   - DEFAULT values

4. **Referential Integrity**
   - ON DELETE CASCADE
   - ON DELETE SET NULL
   - ON UPDATE CASCADE

5. **Relationships**
   - One-to-Many
   - Many-to-Many
   - Junction tables

## 📁 Project Structure

```
database/
├── migrations/          # Raw SQL table creation scripts
│   ├── create_departments_table.php
│   ├── create_instructors_table.php
│   ├── create_courses_table.php
│   ├── create_students_table.php
│   └── create_registrations_table.php
├── seeders/            # Sample data population
└── factories/          # Data factories

app/Models/             # Eloquent ORM models
├── Department.php
├── Instructor.php
├── Course.php
├── Student.php
└── Registration.php
```

## 🎓 Learning Outcomes

Through this project, you can learn:
- How to design a normalized relational database
- Writing raw MySQL DDL commands
- Understanding foreign key relationships and cascade operations
- Implementing many-to-many relationships
- Using constraints to maintain data integrity
- Working with timestamps and auto-generated values

## 📝 License

This is an educational project created for learning purposes.

## 👤 Author

Created as a database learning project for Academic Course 3-1

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
