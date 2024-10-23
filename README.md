# DefectLog

## Overview

**DefectLog** is a web application for tracking and managing defects in software development. Built with **Laravel 11**, **Inertia.js**, and **Vue.js**, this application provides a user-friendly interface for logging, categorizing, and resolving defects, ensuring teams can effectively collaborate to improve product quality.

## Features

- **User Authentication:** Secure registration and login processes.
- **Defect Management:** Log and manage defects with detailed descriptions.
- **Real-Time Updates:** Leverage Vue.js for dynamic, real-time updates without refreshing the page.
- **Search and Filtering:** Easily search and filter defects.
- **Commenting System:** Facilitate discussion and updates on specific defects.

## Technologies Used

- **Backend:** Laravel 11
- **Frontend:** Inertia.js, Vue.js
- **Database:** MySQL
- **CSS Framework:** Tailwind CSS (or any other CSS framework you prefer)

## Installation

To set up **DefectLog** on your local machine, follow these steps:

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js >= 16
- MySQL

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/defectlog.git

2. **Add AdminUser:**
   php artisan db:seed --class=AdminUserSeeder

3. **Migrate:**
   php artisan Migrate
