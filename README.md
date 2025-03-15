## EVENT DICTIONARY

## Installation

### Prerequisites

- PHP >= 8.1
- Composer
- MySQL

### Steps

1. Clone the repository:

    ```bash
    git clone https://github.com/mohamednayef/EVENT_DICTIONARY.git
    cd EVENT_DICTIONARY
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Set up the environment variables:

    ```bash
    cp .env.example .env
    ```

    - Update your `.env` file with your database and mail configurations and FILESYSTEM_DISK=public.
    - (optional) google client configration.
    - APP_NAME="YourAppName"
    - APP_URL=http://localhost
    - DB_DATABASE=your_database_name
    - DB_USERNAME=your_database_user
    - DB_PASSWORD=your_database_password

4. Run the migrations and seed the database:

    ```bash
    php artisan migrate:fresh --seed
    ```

5. Serve the application:

    ```bash
    php artisan serve
    ```