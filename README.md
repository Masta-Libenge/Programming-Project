🚀 Deployment Steps (Laravel Project)
Follow these steps to set up and deploy this Laravel project locally or on a server.

🔧 Requirements
PHP >= 8.1

Composer

MySQL (or MariaDB)

Node.js & npm (for frontend assets, optional)

1. 📥 Clone the Repository
git clone https://github.com/your-username/your-repo.git
cd your-repo

2. 📦 Install Dependencies
composer install
npm install && npm run dev # (Optional: for front-end assets)

3. ⚙️ Set Up Environment
cp .env.example .env

Update the .env file with your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_db
DB_USERNAME=root
DB_PASSWORD=your_password

4. 🔑 Generate Application Key
php artisan key:generate

5. 🛠 Run Migrations (Set Up Database Tables)
php artisan migrate

Optional: Run seeders to create default users or test data:
php artisan db:seed

6. 🧪 Serve the Application
php artisan serve

Open http://localhost:8000 in your browser.

✅ Features
Laravel MVC structure: Controllers, Routing, Views (Blade)

User roles handled via MySQL database

Conditional rendering via controllers based on user type
