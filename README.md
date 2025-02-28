## **Blog App with Real-Time Updates (Powered by Reverb) 🚀**  

### **Overview**  
This is a **real-time blog application** built with **Laravel** and **Reverb**, allowing users to create, update, and interact with blog posts seamlessly without page refreshes.  

### **Features**  
✅ **User Authentication** (Register/Login)  
✅ **Create, Read, Update, Delete (CRUD) Blogs**  
✅ **Real-Time Blog Updates** using Reverb  
✅ **Live Notifications for Blog Updates**  
✅ **Modern UI with Tailwind CSS**  

### **Tech Stack**  
- **Backend:** Laravel 11^, MySQL  
- **Frontend:** Blade, Alpine.js  
- **Real-Time:** Reverb   

### **Installation**  
#### **1️⃣ Clone the Repo**  
```bash
git clone https://github.com/Waris10/Real-time-Blog-App-With-Laravel-Reverb.git
```
#### **2️⃣ Install Dependencies**  
```bash
composer install
npm install
```
#### **3️⃣ Setup Environment**  
```bash
cp .env.example .env
php artisan key:generate
```
- Configure `.env` with **database credentials**  
- Set **BROADCAST_CONNECTION=reverb**  


#### **5️⃣ Start the Application**  
```bash
php artisan serve
```

#### **6️⃣ Start Reverb for Real-Time Updates**  
```bash
php artisan reverb:start
```
