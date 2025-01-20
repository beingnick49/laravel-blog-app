# Laravel Blog App Project

## Project Overview

This is a simple blog site which supports user registration, login, and CRUD operations for blog posts. It also includes a public blog display page accessible without authentication.

## Development environment

-   PHP 8.2
-   Laravel 11
-   Database (MySQL)

## Setup Instructions

### Step 1: Clone the Repository

```bash
git clone https://github.com/beingnick49/laravel-blog-app.git
cd laravel-blog-app
```

### Step 2: Install Dependencies

```bash
composer install
npm install
npm run build
```

### Step 3: Environment Configuration

1. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```
2. Set the database connection in the `.env` file:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

### Step 4: Database Setup

1. Run migrations to set up the database schema:
    ```bash
    php artisan migrate
    ```
2. (Optional) Seed the database with sample data:
    ```bash
    php artisan db:seed
    ```

### Step 5: File storage linking

```bash
php artisan storage:link
```

### Step 6: Start the Development Server

```bash
php artisan serve
```

Access the application at `http://localhost:8000`.

## Testing Credentials

For testing purposes, you can use the following credentials:

-   **Admin details**:
    -   Username: `admin`
    -   Email: `admin@blog.com`
    -   Password: `secret`
-   **First user details**:
    -   Username: `user1`
    -   Email: `user1@blog.com`
    -   Password: `secret`
-   **Second user details**:
    -   Username: `user2`
    -   Email: `user2@blog.com`
    -   Password: `secret`

## Laravel Features and Tools Used

-   **Authentication**: Laravel UI (package) for authentication.
-   **Routing**: Organized routes in `web.php` for frontend and for backend.
-   **Eloquent ORM**: Used for database interaction.
-   **Middleware**: Protected routes to ensure only authenticated users can perform CRUD operations on their blog posts.
-   **Blade Templates**: Views for frontend design.
-   **Laravel policy**: For authorization.
-   **Migration**: Migration used for database schema design.
-   **Seeder**: Seeder used for database data entry.

## Features

-   **User Registration**:
    -   Form with Email, Username and Password fields.
-   **Admin Login**:
    -   Admin can login with either email or username.
-   **User Login**:
    -   User can login with either email or username.
-   **Blog Management**:
    -   Users can create, read, update and delete their own blog posts.
    -   Feature to upload and display images.
    -   Feature to select category.
    -   Feature to search blogs.
    -   Admin can control the users and blog.
    -   If admin bans the user then all the blogs of respective user will be hidden from frontend.
-   **Public Blog Display**:
    -   List page to view all posts.
    -   Detailed view for individual posts.

Happy Coding 😊
