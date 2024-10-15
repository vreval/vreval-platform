# VREVAL Platform

## Overview

**VREVAL Platform** is a web application designed for creating and managing surveys to evaluate virtual environments, primarily for pre-occupancy evaluations. Built using Laravel and FilamentPHP, this platform allows users to create custom forms, upload 3D models of virtual spaces, define points of interest, and combine these elements into interactive tasks that survey participants can complete.

Participants interact with these surveys through the companion desktop application, **VREVAL Participate**. The platform provides a REST API to facilitate seamless communication between the web and desktop applications.

## Features

- **Survey Builder**: Create customizable surveys with different task types (e.g., Annotation, AB Test, Wayfinding).
- **3D Environment Management**: Upload static 3D mesh data representing virtual environments for participants to explore.
- **Point of Interest (POI)**: Define and map points of interest within virtual environments to create interactive tasks.
- **REST API**: Provides endpoints to communicate with the desktop application for survey participation and data collection.
- **Multi-Tenancy**: Manage multiple projects and user roles with project-based access control.
- **User Management**: Authentication and authorization for users, with the ability to assign roles and manage multiple projects.

## Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- Laravel 9.x
- MySQL or any supported database
- Node.js & npm (for front-end assets)
- FilamentPHP

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/vreval-platform.git
   cd vreval-platform
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   npm run dev
   ```

3. **Set up the environment file:**
   Copy `.env.example` to `.env` and configure the database, mail settings, and other environment variables:
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key:**
   ```bash
   php artisan key:generate
   ```

5. **Run the migrations:**
   ```bash
   php artisan migrate
   ```

6. **Seed the database (optional):**
   If you have seed data to populate the database, run:
   ```bash
   php artisan db:seed
   ```

7. **Start the development server:**
   ```bash
   php artisan serve
   ```

8. **Access the platform**:
   Navigate to `http://localhost:8000` in your web browser.

### API Documentation

The REST API allows the **VREVAL Participate** desktop application to communicate with the platform. You can find detailed API documentation in the `/docs` directory or by navigating to `/api/docs` in the application.

### Testing

To run the unit and integration tests:
```bash
php artisan test
```

## Contributing

Contributions are welcome! Please fork the repository and submit pull requests for new features, bug fixes, or improvements.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.
