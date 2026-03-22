# 📋 Task Tracker System

## 📌 Description
Task Tracker System is a web-based application developed with PHP and MySQL for managing tasks and monitoring work progress.  
The system allows users to create, update, delete, and track tasks efficiently through a simple interface.

---

## 🚀 Features
- Create, Read, Update, Delete (CRUD) tasks
- User login and authentication
- Task status tracking
- Search and filter tasks
- Dashboard for task management
- Due date monitoring

---

## 🛠 Tech Stack
- **Frontend:** HTML, CSS, Bootstrap
- **Backend:** PHP
- **Database:** MySQL
- **Server:** XAMPP / Apache

---

## 📂 Project Structure
```plaintext
task-tracker-system/
├── index.php
├── login.php
├── dashboard.php
├── add_task.php
├── edit_task.php
├── delete_task.php
├── config/
│   └── db.php
├── css/
├── js/
├── database/
│   └── tasktracker.sql
└── README.md
```

---

## ⚙️ Installation & Setup

### 1. Clone the repository
```bash
git clone https://github.com/pinkybhattarai1/task-tracker-system.git
```

### 2. Move project folder to htdocs
Example:
```plaintext
C:\xampp\htdocs\task_app
```

### 3. Start Apache and MySQL
Open **XAMPP Control Panel** and start:
- Apache
- MySQL

### 4. Import database
- Open phpMyAdmin
- Create a database named `tasktracker`
- Import the file `tasktracker.sql`

### 5. Run the project
Open browser and go to:
```plaintext
http://localhost/task-tracker-system
```

---

## 🗄 Database
Example SQL table structure:

```sql
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  status VARCHAR(50),
  due_date DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 📸 Screenshot
- Login page
- Dashboard page
- Add task form
  


## 🎯 Purpose of the Project
This project was developed to practice PHP web development, MySQL database management, and CRUD operations in a task management system.

---

## 👩‍💻 Author
**Pinky Prasat**

---

## 📬 Contact
- **Email:** pinkybhattarai1@gmail.com
- **GitHub:** https://github.com/pinkybhattarai1
