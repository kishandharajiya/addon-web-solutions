# Laravel With Vue


## Features

-   Secure login and logout functionality using OAuth2 authentication.
-   Distinct roles (Admin, User) with specific permissions.
-   Post CRUD operations with attributes such as title, body
-   Email notifications for welcome mail using Event/Listner with additional Laravel Job and Queue functionality.

## Roles

-   **Admin:** Full control over the application including post and user management.
-   **User:** Authorization to manage posts, excluding user management.

## Implementation Steps

1. **Project Setup:** Initialize a new Laravel project setup.
3. **Database Setup:** Use migrations to create database tables and Seeder data for all modules.
4. **Authentication:** Implement user authentication using OAuth2 authentication.
5. **Models and Controllers:** Create relevant models, controllers,repository and other necessary components. Define relationships between models.
6. **Vue Layout:** Implement a basic layout for vue files.
7. **Validation:** Utilize Laravel's built-in validation for data validation before storage.

## Installation

1. Clone the repository.
2. Laravel Version `9.19` PHP Version `8.1.5` Node  version : `18.16.0`  
3. Run `composer install` to install dependencies.
4. Run `npm install` to install node dependencies.
5. Copy `.env.example` to `.env` and configure your environment variables.
6. Run `php artisan key:generate` to generate application key.
7. Run `php artisan migrate` to migrate database tables.
8. Run `php artisan db:seed` to seed the database with initial data.
9. Serve the application using `php artisan serve`.
10. Serve the frontend vite application using `npm run dev`.
11. Command for the Queue request process `php artisan queue:work`.

## Note:
- For the sending mail im use Wpoven free SMTP provider so you get the mail insite the wpoven access inbox [click here](https://www.wpoven.com/tools/free-smtp-server-for-testing)


## Contributors

-   Kishan Dharajiya <kishandharajiya@gmail.com>

