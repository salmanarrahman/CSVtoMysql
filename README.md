# CSV to MYSQL Application

This is a **CSV to MYSQL Application** developed with use of Laravel 12, MySQL database, Tailwind CSS. Follow this guide to install and run the project in your local machine.

## Requirements

Before starting, ensure you have the following installed:

- **PHP**: 8.2 or higher
- **Laravel**:  12
- **Composer**: Latest stable version
- **MySQL**: Compatible with Laravel requirements
- **Node.js**: Latest stable version (with `npm` package manager)
- **Git**: To clone the repository
- A local server environment like [Laravel Sail](https://laravel.com/docs/stable/sail), [XAMPP](https://www.apachefriends.org/), [MAMP](https://www.mamp.info/en/), or equivalent.

---

## Installation Guide

Follow these steps to set up the Laravel application on your local machine:

### 1. Clone the Repository

First, clone the project to your local machine using the following command:

```bash
git clone https://github.com/salmanarrahman/CSVtoMysql.git
```

Then navigate into the project directory:

```bash
cd <CSVtoMysql>
```

---

### 2. Install Dependencies

Install PHP dependencies using Composer:

```bash
composer install
```

Install JavaScript dependencies using npm:

```bash
npm install
```

---

### 3. Configure Environment Variables

Copy the `.env.example` file to a new `.env` file:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other configuration values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

---

### 4. Generate Application Key

Run the following command to generate the application's encryption key:

```bash
php artisan key:generate
```

---

### 5. Run Migrations

Run database migrations to create the necessary tables:

```bash
php artisan migrate
```

---

### 6. Compile Assets

Run the following commands to compile frontend assets:

```bash
npm run dev
```

---

### 7. Start the Development Server

To start the Laravel development server, run:

```bash
php artisan serve
```

This will start the application at `http://127.0.0.1:8000`.

---


---

## Additional Information

### Using of XAMPP or WAMPP
Make sure your Apache,MySQL server is Running

---


## License

This project is open-source and available under the [MIT License](LICENSE).

---
