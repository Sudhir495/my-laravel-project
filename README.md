
# 🏢 Multi-Tenant SaaS Application

A Laravel-based multi-tenant SaaS application where users can register, log in, and manage multiple companies under their profile. Each user can create, edit, delete, and switch between companies, with full UI and API access. Tailwind CSS powers a modern and responsive user interface.

---

## 🚀 Features

- **Authentication**: User registration, login, and logout using [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze).
- **Multi-Tenant Logic**: Users manage multiple companies (name, address, industry) under their profile.
- **Company Switching**: Set an "active company" to scope all actions.
- **API Endpoints**: RESTful API secured with [Laravel Sanctum](https://laravel.com/docs/sanctum).
- **Modern UI**: Tailwind CSS + responsive layout, with sidebar, header, and dropdowns.
- **Data Scoping**: Middleware ensures users only access their own data.
- **Soft Deletes**: Protects companies from accidental deletion.

---

## 🛠️ Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/Sudhir495/my-laravel-project.git
cd my-laravel-project
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
php artisan key:generate
```

### 4. Database Setup
- Create a database in MySQL (e.g., `multi_tenant_saas`)
- Update `.env` with your database credentials
```env
DB_DATABASE=multi_tenant_saas
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrate the Database
```bash
php artisan migrate
```

### 6. Install Laravel Sanctum
```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 7. Compile Frontend Assets
```bash
npm run dev
```

_For production:_
```bash
npm run build
```

### 8. Start the Development Server
```bash
php artisan serve
```

Visit the app at:  
📍 `http://127.0.0.1:8000/`

---

## 🌐 Web Interface

- **Login/Register**: http://127.0.0.1:8000/login or /register  
- **Dashboard**: http://127.0.0.1:8000/dashboard  
- **Manage Companies**: http://127.0.0.1:8000/companies  

---

## 🔐 API Endpoints (Sanctum Auth Required)

### Authentication

- **Register**
  ```
  POST /api/register
  Body:
  {
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
  }
  ```

- **Login**
  ```
  POST /api/login
  Body:
  {
    "email": "john@example.com",
    "password": "password"
  }
  ```

- **Logout**
  ```
  POST /api/logout
  Header: Authorization: Bearer <token>
  ```

### Company Management

- **List Companies**
  ```
  GET /api/companies
  Header: Authorization: Bearer <token>
  ```

- **Create Company**
  ```
  POST /api/companies
  Body:
  {
    "name": "My Company",
    "address": "123 Street",
    "industry": "Tech"
  }
  ```

- **Update Company**
  ```
  PUT /api/companies/{id}
  ```

- **Delete Company**
  ```
  DELETE /api/companies/{id}
  ```

- **Set Active Company**
  ```
  POST /api/companies/{id}/set-active
  ```

---

## 🧪 Testing the App

### Web UI:

1. Register a new user at [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)
2. Login and visit [Companies](http://127.0.0.1:8000/companies)
3. Create, set active, edit, and delete companies
4. Buttons are fully visible after compiling assets with `npm run dev`

### API:

Test via Postman or cURL:

```bash
curl -X POST http://127.0.0.1:8000/api/login -H "Content-Type: application/json" -d '{"email":"john@example.com","password":"password"}'
```

---

## 🧩 Database Structure

| Table | Description |
|-------|-------------|
| `users` | Stores user credentials and `current_company_id` |
| `companies` | Stores companies linked via `user_id` |

---

## 🔐 Multi-Tenancy and Scoping

- Each user can manage multiple companies (`hasMany`).
- Only the **active company** (via `current_company_id`) is scoped.
- Middleware ensures valid company context is always set.
- Actions like view, update, or delete validate ownership (`$company->user_id === auth()->id()`).

---

## 💡 Notes

- Ensure Tailwind is compiled via `npm run dev` for buttons and layouts to render correctly.
- Soft deletes prevent permanent company loss.
- All API responses include validation errors for bad requests.
- Code is modular and extensible — future modules (e.g., Projects, Invoices) can be scoped to active companies.

---

## 🧹 Common Troubleshooting

| Issue | Solution |
|-------|----------|
| Buttons not visible | Run `npm run dev` to compile Tailwind CSS |
| Companies not showing | Ensure `auth()->user()->companies` is not empty |
| Cache issues | Run `php artisan cache:clear && php artisan view:clear && php artisan route:clear` |

---

## 📄 License

This project is open-source and available for educational and commercial use.

---

## 👨‍💻 Author

**SUDHIR KUMAR**  
Email: sudheerkumar495@gmail.com  
GitHub: [@Sudhir495](https://github.com/Sudhir495)
