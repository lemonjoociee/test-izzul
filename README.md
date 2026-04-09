# ToDoList System (Laravel + Vue)

A simple full-stack ToDoList web application built using Laravel and Vue.js. This system allows users to manage their tasks efficiently with full CRUD functionality.

---

## Features

- User Authentication (Login & Register)
- Create new tasks
- View task list
- Update task (edit title & mark complete)
- Delete task
- Clean and responsive UI
- Secure routes with authentication

---

## Tech Stack

- **Backend:** Laravel 13
- **Frontend:** Vue.js (Inertia.js)
- **Database:** SQLite
- **Styling:** Tailwind CSS
- **Build Tool:** Vite

---

## Installation & Setup

1. Clone the repository:
git clone https://github.com/lemonjoociee/test-izzul.git
cd test-izzul

2. Install dependencies:
composer install
npm install

3. Setup environment:
cp .env.example .env
php artisan key:generate

4. Run migrations:
php artisan migrate

5. Start the development server:
npm run dev
php artisan serve


Access the Application
Open your browser and go to:
http://127.0.0.1:8000

Project Structure
app/Http/Controllers → Backend logic
resources/js/Pages → Vue frontend pages
routes/web.php → Application routes
database/migrations → Database schema

robots.txt
A robots.txt file is included in the public folder as required.

Notes
Authentication is required to access the ToDoList.
Users cannot access protected pages after logout.
Built as part of a Full Stack Web Developer assessment.

Author
Izzul Dinie
GitHub: https://github.com/lemonjoociee

#STEP 3: Push README

Run:

```bash
git add README.md
git commit -m "Add professional README"
git push