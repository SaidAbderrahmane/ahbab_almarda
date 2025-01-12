about us :
Membre de l'association "Amis du Malade", une association à but humanitaire, dont les missions comprennent l'organisation de campagnes de don de sang, de campagnes de sensibilisation et de conférences dans le domaine de la santé, ainsi que le soutien matériel et moral aux patients



# Project Title

## Overview
This project is a web application built using Laravel and Vue.js. It aims to provide a platform for managing blood donation campaigns and donor information. The application is designed for use by donors, collaborators, and administrators, each with specific functionalities.

## Project Structure

- `app/Models`: Contains the Eloquent models for interacting with the database.
- `app/Http/Controllers`: Houses the controllers that handle the incoming requests and return responses.
- `resources/views`: Contains Blade templates for rendering the HTML pages.
- `resources/js`: Includes JavaScript files for adding interactivity to the frontend.

## Key Features

- Manage blood donation campaigns.
- Record and view donor information.
- Manage user roles and access permissions.
- Access a dashboard with key statistics and summaries.
- Manage cities and hospitals.

## Roles and privilges

### Guest
- View homepage with hero section and informational content.
- Access information about the year's blood donation campaigns.
- Learn about the association and contact details.

### Donor
- View and update personal information.
- Review personal donation history.

### Collaborator
- Access active donation information.
- View list of donors.

### Admin
- Dashboard with key statistics.
- Manage campaigns, locations, and user information.

### Screenshots

![dashboard](/screenshots/dashboard1.png)
![dashboard](/screenshots/dashboard2.png)
![compaigns](/screenshots/compaigns.png)
![locations](/screenshots/locations.png)

    

## Installation

1. Clone the repository.
2. Run `composer install` to install PHP dependencies.
3. Run `npm install` to install JavaScript dependencies.
4. Copy `.env.example` to `.env` and configure your environment variables.
5. Run `php artisan key:generate` to generate the application key.
6. Run `php artisan migrate` to set up the database.

## Usage

- Start the development server using `npm run dev`.
- Access the application at `http://localhost:8000`.




