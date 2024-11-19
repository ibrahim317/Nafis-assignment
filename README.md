# Prerequisites Installation Guide

## System Requirements

-   PHP 8.2 or higher
-   Composer (Latest version)
-   Docker & Docker Compose
-   Node.js (Latest LTS version)
-   MySQL PHP Extensions
-   Other PHP Extensions

## Installation Steps

### 1. PHP Installation

#### For Ubuntu/Debian:

```bash
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath
```

#### For macOS:

```bash
brew install php@8.2
```

#### For Windows:

-   Download PHP 8.2 from [windows.php.net](https://windows.php.net/download/)
-   Add PHP to your system's PATH

### 2. Composer Installation

#### For Unix-based systems (Linux/macOS):

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
```

#### For Windows:

-   Download and run the Composer installer from [getcomposer.org](https://getcomposer.org/download/)

### 3. Docker Installation

For detailed installation instructions, please refer to the official Docker documentation:

-   [Docker Installation for Ubuntu](https://docs.docker.com/engine/install/ubuntu/)
-   [Docker Desktop for macOS](https://www.docker.com/products/docker-desktop)
-   [Docker Desktop for Windows](https://www.docker.com/products/docker-desktop)

### 4. Node.js Installation

#### Using NVM (recommended):

```bash
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
nvm install --lts
```

#### Direct installation:

-   Download and install from [nodejs.org](https://nodejs.org/)

## Verification

Verify your installations by running:

```bash
php -v                # Should show PHP 8.2.x
composer -V           # Should show Composer version
docker -v            # Should show Docker version
node -v              # Should show Node.js version
npm -v               # Should show npm version
```

## Starting the Services

1. Start Docker services:

```bash
docker compose up -d
```

This will start:

-   MySQL server on port 3307
-   MailHog for email testing on ports 8025 (web interface) and 1025 (SMTP server)

## Additional Configuration

1. Copy the environment file:

```bash
cp .env.example .env
```

2. Install PHP dependencies:

```bash
composer install
```

3. Install Node.js dependencies:

```bash
npm install
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Run migrations:

```bash
php artisan migrate
```

Now your development environment should be ready to run the Laravel application. You can start the development server using:

```bash
composer run dev
```

This will concurrently run:

-   Laravel server
-   Schedule worker

## API Documentation

For API documentation, you can use the provided Postman collection.
The collection file is named `Nafis-assigement.postman_collection.json`.
You can import this file into Postman to explore and test the API endpoints.

## Running Tests

### PHPUnit Tests

To run the automated test suite:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter TaskCrudTest
```

Test files are located in the `tests` directory:

-   `tests/Unit/` - Unit tests
-   `tests/Feature/` - Feature tests
