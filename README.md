# 🏨 Hotel Management System

A complete **web-based Hotel Management System** built using **PHP** and **MySQL**. This project allows hotel staff to efficiently manage customers, rooms, bookings, payments, and generate receipts.

---

## ✨ Features

- ➕ Add New Customers
- 🏠 Add and Manage Rooms
- 🛏️ Book Rooms with Check-in and Check-out Dates
- 💳 Handle Payments and Generate Receipts
- 📋 View All Bookings and Status
- 🔐 Admin Login System
- 🧾 Printable Receipts
- 🧠 Triggers to manage data cleanup after checkout

---

## 🛠️ Technologies Used

- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP (Core PHP)
- **Database**: MySQL
- **Server**: XAMPP / Localhost

---

## 🧾 How to Setup Locally

1. 🧱 Clone or download this repository.
2. 📂 Place hotel-management folder inside your XAMPP `htdocs` folder.
3. 🔥 Start Apache and MySQL from XAMPP Control Panel.
4. 🗂️ Open **phpMyAdmin** and import the `hotel_db.sql` file into a new database.
5. 🌐 Open your browser and navigate to:
[http://localhost/hotel/](http://localhost/hotel-management/login.php)

---

## 🔐 Admin Login

- **Username:** `admin`
- **Password:** `admin123`

---

## 📸 Screenshots

>![image](https://github.com/user-attachments/assets/0432a6cf-a8f2-43df-bfa9-1003a49f56d0)
>This page allows the administrator to securely log into the hotel management system using a username and password. Passwords are verified using hashing techniques for added security.
>![image](https://github.com/user-attachments/assets/d2315c05-4d74-4956-a4f1-083ab7a873d2)
>The central hub of the system. From here, the admin can navigate to all major functionalities like adding customers, booking rooms, checking out, viewing bookings, recording payments, and generating receipts.
>![image](https://github.com/user-attachments/assets/e6f68a3d-6a8f-4f70-b593-a31984afc2c7)
>This form collects customer information including name, email, phone, address, number of guests, and guest names. It checks for duplicate entries before inserting new customers.
>![image](https://github.com/user-attachments/assets/baf56dc2-2e78-4741-801f-fe77c7fbc5eb)
>This section is used to add hotel rooms with specific room types, prices, and availability status. Rooms can later be assigned to bookings based on availability.
>![image](https://github.com/user-attachments/assets/5880904b-6849-4717-9003-ea0c3dabad8d)
>Displays booking and customer details. Admin can enter and record the payment amount. After payment, it automatically shows a styled receipt and provides a print option.
>![image](https://github.com/user-attachments/assets/f0dd5c1d-d777-40f9-903e-d7d3443fd83d)
>Displays all bookings in a tabular format including booking ID, customer name, room type, check-in and check-out dates, and booking status (Booked or Completed).
>![image](https://github.com/user-attachments/assets/083f73f9-fba5-4f73-894a-4133c2abbe50)
>Lets the admin check out a customer. It updates the booking status to "Completed" and makes the room available again. It can optionally trigger customer removal via a MySQL trigger if no more active bookings exist.


---

## 📄 Project Report

📘 You can download the full project report here:  
👉 [Hotel_Management_Project_Report.pdf](./Hotel_Management_Project_Report.pdf)

---

## 📜 License

This project is open-source and free to use for learning and educational purposes.
