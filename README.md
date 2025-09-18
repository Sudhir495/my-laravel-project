
# 🏢 Multi-Tenant SaaS Application

## 🚀 Features

- **Authentication**: User registration, login, and logout using [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze).
- **Multi-Tenant Logic**: Users manage multiple companies (name, address, industry) under their profile.
- **Company Switching**: Set an "active company" to scope all actions.
- **API Endpoints**: RESTful API secured with [Laravel Sanctum](https://laravel.com/docs/sanctum).
- **Modern UI**: Tailwind CSS + responsive layout, with sidebar, header, and dropdowns.
- **Data Scoping**: Middleware ensures users only access their own data.
- **Soft Deletes**: Protects companies from accidental deletion.

## 🛠️ Setup Instructions

### 1. Clone the Repository
git clone https://github.com/Sudhir495/my-laravel-project.git
cd my-laravel-project


### 2. Install Dependencies

composer install
npm install

### 3. Environment Setup

php artisan key:generate

### 4. Database Setup

- Check `.env` with your database credentials 
DB_DATABASE=multi_tenant_saas
DB_USERNAME=root
DB_PASSWORD=

### 5. Migrate the Database
php artisan migrate

### 6. Install Laravel Sanctum
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

### 7. Compile Frontend Assets
npm run dev

_For production:
npm run build

### 8. Start the Development Server
php artisan serve

Visit the app at:  
📍 `http://127.0.0.1:8000/

## 🌐 Web Interface

- **Login/Register**: http://127.0.0.1:8000/login or /register  
- **Dashboard**: http://127.0.0.1:8000/dashboard  
- **Manage Companies**: http://127.0.0.1:8000/companies  

## 🧪 Testing the App

### Web UI:

1. Register a new user at [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)
2. Login and visit [Companies](http://127.0.0.1:8000/companies)
3. Create, set active, edit, and delete companies
4. Buttons are fully visible after compiling assets with `npm run dev`

##  Database Structure

| Table | Description |
|-------|-------------|
| `users` | Stores user credentials and `current_company_id` |
| `companies` | Stores companies linked via `user_id` |

## Multi-Tenancy and Scoping

- Each user can manage multiple companies (`hasMany`).
- Only the **active company**(via `current_company_id`) is scoped.
- Middleware ensures valid company context is always set.
- Actions like view,update,ordelete validate ownership (`$company->user_id===auth()->id()`).

---

## 👨‍💻 Author

**SUDHIR KUMAR**  
Email: sudheerkumar495@gmail.com  
GitHub: [@Sudhir495](https://github.com/Sudhir495)
