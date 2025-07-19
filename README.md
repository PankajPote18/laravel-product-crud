# Laravel Product CRUD Application

A simple yet powerful **Product Management System** built with **Laravel**.  
This app allows you to:

✔ Add new products with image uploads  
✔ View product details on a dedicated page  
✔ Edit and delete products  
✔ Search, sort, and paginate products using **DataTables**  
✔ Includes **form validation** and clean **Bootstrap UI**

---

## 📌 Features

✅ Create, Read, Update, and Delete (CRUD) operations for products  
✅ Image upload with Laravel storage  
✅ Form validation with error messages  
✅ Datatables for searching & sorting  
✅ Clean and responsive design using **Bootstrap 5**


---

## 🛠️ Technologies Used

- **Laravel 10** (PHP Framework)  
- **MySQL** (Database)  
- **Bootstrap 5** (Frontend)  
- **jQuery & DataTables** (Search & Pagination)

---

## ⚙️ Installation & Setup (Run Locally)

Follow these steps after cloning the repo:

### 1. Clone the Repository
git clone https://github.com/PankajPote18/laravel-product-crud.git
cd laravel-product-crud
### 2. Install PHP Dependencies
composer install
### 3. Install Node (Optional for CSS/JS)
npm install
### 4. Create Your `.env` File
cp .env.example .env
### 5. Set Up Your Database
Open `.env` and update these lines:
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
*(Your details remain private because `.env` is never pushed to GitHub)*
### 6. Generate App Key
php artisan key:generate
### 7. Run Migrations (Creates Tables)
php artisan migrate
### 8. Run the Development Server
php artisan serve

Now visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔒 Security Note 

✔ **Your database password and sensitive data are safe** because `.env` is listed in `.gitignore` and is **never pushed to GitHub**.  
✔ Only the **migration files** (table structure, no real data) are shared.  
✔ Other users will create their own `.env` file with their own database credentials.

---

## 🤝 Contributing

Feel free to fork this repository and improve the features. Pull requests are welcome.

---

## ✨ Author

Developed by **Pankaj Pote**
