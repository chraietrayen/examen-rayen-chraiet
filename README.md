🎯 Web Application - User & Product Management
This is a Symfony web application featuring user registration, login, and product management functionalities.

🗂️ Project Structure
bin/: ⚙️ Console commands

config/: 🛠️ Application configuration

migrations/: 🔄 Database migration files

public/: 🌐 Web accessible root (contains index.php, assets)

src/: 💻 PHP source code (Controllers, Entities, Repositories)

templates/: 🧩 Twig templates

var/: 📦 Cache, logs

.env: 🧪 Environment configuration (database credentials, app secret, etc.)

composer.json: 📜 PHP dependencies

🧰 Setup Instructions
📥 Clone the Repository

bash
Copy
Edit
git clone <repository-url>
cd examen-rayen-chraiet
📦 Install Dependencies
Make sure you have Composer installed.
Navigate to the inner examen-rayen-chraiet directory:

bash
Copy
Edit
cd examen-rayen-chraiet 
composer install
⚙️ Configure Environment Variables

Copy the .env file if it doesn't exist: cp .env.example .env

Edit the .env file and set your database connection details.
Example for MySQL:

ini
Copy
Edit
DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0.32&charset=utf8mb4"
✅ Ensure the database exists and matches db_name.

🛠️ Run Database Migrations

bash
Copy
Edit
php bin/console doctrine:database:create --if-not-exists
php bin/console make:migration 
php bin/console doctrine:migrations:migrate
(You might skip make:migration if migrations are already in sync.)

🎨 Ensure Stylesheet Exists
Make sure public/css/style.css is present.

🚀 Running the Application
🔌 Start the Symfony Web Server

bash
Copy
Edit
symfony server:start
Or use the built-in PHP server:

bash
Copy
Edit
php -S 127.0.0.1:8000 -t public
🌍 Access the Application
Visit: http://127.0.0.1:8000

🧩 Main Functionalities
👤 User Registration (/register)

🔐 User Login (/login)

🏠 Welcome Page (/)

📦 Product Management Dashboard (/produits/dashboard)

➕ Add Product (/produits/add)

📃 List Products (/produits/list)

📝 Notes
🧭 Uses Symfony attribute routing

🗃️ Entities (Utilisateur, Produit) managed by Doctrine ORM

💡 Templates are in Twig

📁 Ensure you’re in the inner examen-rayen-chraiet folder when running CLI commands
