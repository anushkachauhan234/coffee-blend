# ☕ Coffee Blend Café Website

A complete **PHP + MySQL** based Café Management System where users can browse the menu, place orders, make table bookings, and write reviews.  
Includes a full-featured **Admin Panel** for managing products, orders, bookings, and administrators.

---

## 🧩 Table of Contents

- [Overview](#-overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Setup Instructions](#-setup-instructions)
- [Database Schema](#-database-schema)
- [Screenshots](#-screenshots)
- [Author](#-author)
- [License](#-license)
- [Future Enhancements](#-future-enhancements)

---

## 🌟 Overview

**Coffee Blend Café Website** is designed to streamline the café’s online presence — allowing users to:
- Explore the café menu
- Place orders online
- Reserve tables in advance
- Write and view reviews

Admins can manage:
- Products (add, edit, delete)
- Orders (view, approve, delete)
- Bookings (accept or reject)
- Admin users

---

## 🚀 Features

### 👩‍🍳 User Panel
- 🍰 **Browse Menu:** View coffee and dessert categories.
- 🛒 **Add to Cart:** Add favorite items to the cart.
- 💳 **Checkout:** Proceed to checkout and confirm orders.
- 📅 **Book Table:** Select date and time to reserve.
- 🧾 **Order History:** Track previous orders and bookings.
- ✍️ **Write Reviews:** Give feedback on menu items.
- 🔐 **User Authentication:** Register, login, and logout securely.

### 🧑‍💼 Admin Panel
- 🗂️ **Manage Products:** Create, view, update, and delete menu items.
- 🛍️ **Manage Orders:** Update order status (Pending → Completed).
- 📖 **Manage Bookings:** Approve or reject user bookings.
- 👥 **Manage Admins:** Create or remove admin accounts.
- 📊 **Dashboard:** View quick stats for all activities.

---

## 🛠️ Tech Stack

| Category | Technology |
|-----------|-------------|
| **Frontend** | HTML5, CSS3, JavaScript |
| **Backend** | PHP (Core PHP) |
| **Database** | MySQL |
| **Server** | Apache (via XAMPP) |
| **Version Control** | Git & GitHub |

---

## 📂 Project Structure

coffee-blend/
├── admin-panel/ # Admin dashboard files
│ ├── admins/ # Manage admin accounts
│ ├── bookings-admins/ # Manage table bookings
│ ├── orders-admins/ # Manage orders
│ ├── products-admins/ # Manage products and images
│ ├── layouts/ # Common header/footer for admin
│ └── styles/ # Admin panel CSS
│
├── auth/ # User authentication (login/register/logout)
├── booking/ # Booking functionality
├── products/ # Cart, checkout, and product pages
├── reviews/ # Write and manage user reviews
├── users/ # User dashboard for bookings and orders
├── config/ # Database connection (config.php)
├── css/, js/, scss/ # Frontend styles and scripts
├── includes/ # Header and footer for frontend pages
├── images/, fonts/ # Static assets
├── index.php # Homepage
├── about.php, contact.php, menu.php, services.php
└── 404.php # Custom error page


## ⚙️ Setup Instructions

### 1️⃣ Prerequisites
Ensure you have:
- [XAMPP](https://www.apachefriends.org/) or any PHP local server
- PHP ≥ 7.4
- MySQL Database

### 2️⃣ Clone the Repository
```bash
git clone https://github.com/anushkachauhan234/coffee-blend.git



👩‍💻 Developed by: Anushka Chauhan
📧 Contact: chauhananushka238@gmail.com
