# Peta Kerawanan
**Peta Kerawanan** is a project designed to simplify the creation, management, and modification of digital content without requiring extensive technical knowledge. This system provides an intuitive user interface for administrators and content creators to handle website content efficiently.

## Technology Used

We use some frameworks and libraries to make this project, such as:
- Laravel (PHP, for backend)
- Bootstrap (for UI/UX icons)
- Tailwind (for CSS Design)


## How to run?

To run this project, you need to follow these steps:

### 1. Clone this repository

```bash
git clone https://github.com/Izaaah/peta-kerawanan-php.git
cd skripsi-scheduling
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Configure the Environment

> [!IMPORTANT] 
> Please copy the `.env.example` and paste it to `.env` file first.

- Build the frontend assets.

    ```bash
    npm run build
    ```

- Setup the Laravel 12

    ```bash
    php artisan key:generate
    php artisan storage:link
    php artisan config:clear
    php artisan migrate
    ```

### 4. Run the Application

Start the Laravel Development Server :

```bash
php artisan serve
```

Now, you should be able to access the application at http://127.0.0.1:8000.

## Troubleshooting

> [!IMPORTANT]
> For developers, please, after doing some changes on database (using migration), do this command : 

```bash
php artisan migrate:refresh
```

> [!NOTE]
> This issue is known to occur on PHP version 8.4.

If you encounter issues during installation—such as Composer failing to install packages due to platform requirements—you can try running:

```bash
composer install --ignore-platform-req=ext-fileinfo
```

Having problem with compiler and design bugs?

> [!TIP]
> This is useful to clear cache.

Try this command : 
```bash
php artisan clear-compiled
php artisan optimize:clear
php artisan route:clear
php artisan view:clear
```
