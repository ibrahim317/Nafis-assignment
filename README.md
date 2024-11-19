# Task Management Application Documentation (Nafis Assignment)

## Table of Contents

-   [Prerequisites Installation Guide](#prerequisites-installation-guide)
    -   [Linux Installation Guide](#linux-installation-guide)
    -   [Mac Installation Guide](#mac-installation-guide)
    -   [Windows Installation Guide](#windows-installation-guide)
-   [Starting Services](#starting-services)
-   [Application Configurations](#application-configurations)
-   [Testing](#testing)
-   [Additional Features](#additional-features)
-   [Development Commands](#development-commands)
-   [Default Test Credentials](#default-test-credentials)

## Prerequisites Installation Guide

### System Requirements

-   PHP 8.2 or higher
-   Composer
-   Node.js & NPM
-   Docker

### Linux Installation Guide

1. Update package manager:
    ```bash
    sudo apt update
    ```
2. Install PHP and required extensions:
    ```bash
    sudo apt install php8.2 php8.2-mysql php8.2-xml php8.2-curl
    ```
3. Install Composer:
    ```bash
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    ```
4. Install Docker:
    - For Ubuntu, follow the instructions at [Docker Ubuntu Installation Guide](https://docs.docker.com/engine/install/ubuntu/)

### Mac Installation Guide

1. Install Homebrew if not installed:
    ```bash
    /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
    ```
2. Install PHP:
    ```bash
    brew install php@8.2
    ```
3. Install Composer:
    ```bash
    brew install composer
    ```
4. Install Docker:
    - For Mac, follow the instructions at [Docker Mac Installation Guide](https://docs.docker.com/desktop/mac/install/)

### Windows Installation Guide

1. Download and install PHP from [php.net](https://windows.php.net/download/)
2. Enable required extensions in `php.ini` file
3. Download and install Composer from [getcomposer.org](https://getcomposer.org/download/)
4. Add PHP and Composer to system PATH
5. Install Docker:
    - For Windows, follow the instructions at [Docker Windows Installation Guide](https://docs.docker.com/desktop/windows/install/)

### Installation Verification

1. Verify PHP installation:
    ```bash
    php -v
    ```
2. Verify Composer installation:
    ```bash
    composer -V
    ```

## Starting Services

1. Clone the repository
2. Run the database and mail services:
    ```bash
    docker compose up -d
    ```
4. Install PHP dependencies:
    ```bash
    composer install
    ```
5. Copy .env.example to .env:
    ```bash
    cp .env.example .env
    ```
6. Generate application key:
    ```bash
    php artisan key:generate
    ```
7. Run database migrations:
    ```bash
    php artisan migrate --seed
    ```
8. Start the development server:
    ```bash
    composer run dev
    ```

   Now we have three services running:
   1. Laravel application:``http://127.0.0.1:8000``
   2. Database server on port ``3307`` (Not 3306 due to not conflict with database services running on the host machine)
   3. Mail web interface on ``http://localhost:8025``  

## Application Configurations

1. Database Configuration:

    When you run docker compose, it sets up the database according to the `compose.yml` file. The Laravel application then connects to this database using the settings specified in the `.env` file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3307
    DB_DATABASE=task_management
    DB_USERNAME=root
    DB_PASSWORD=rootpassword
    ```

    > **Note:**
    > You are free to use your own database, without docker compose, but make sure to update the `.env` file with the correct database settings.

2. Application Settings:
    - Application Name: Configure in .env with APP_NAME
    - Timezone: Set in .env with APP_TIMEZONE (default: UTC)
    - Debug Mode: Toggle in .env with APP_DEBUG
    - Application URL: Set in .env with APP_URL

## Testing

### API Testing (Postman Collection)

1. Import the Postman collection `Nafis-assignment.postman_collection.json`
2. Available API endpoints:
    - Task List
    - Task Details
    - Task Creation
    - Task Updates
    - Task Deletion
    - Task Filtering
    - Task Assignment
    - User Tasks

### PHPUnit Testing

1. Configure testing database in .env.testing
2. Run tests:
    ```bash
    php artisan test
    ```

## Additional Features

### Task Management

-   Create tasks with title, description, and due date
-   Assign tasks to users
-   Filter tasks by status and date range
-   Automatic overdue task marking
-   Task reminder notifications

### Composer Command

By running `composer run dev`, the following tasks will be handled automatically:

-   Starting the Laravel development server
-   Starting the scheduler in the background which will handle the following tasks:
    -   Marking overdue tasks
-   Sending notifications to users

### Available Task Statuses

-   pending
-   in_progress
-   completed

## Development Commands

1. Notify users about tasks due soon manually:

    ```bash
    php artisan notify-users
    ```

2. Run the task overdue checker manually:
    ```bash
    php artisan mark-overdue
    ```

## Default Test Credentials

-   Email: test@example.com
-   Name: Test User
