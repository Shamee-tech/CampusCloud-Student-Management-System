# ☁️ CampusCloud – Student Management System

A cloud-based Student Management System developed using PHP and MySQL and deployed on Amazon Web Services (AWS). The application provides student record management and document upload/download functionality using AWS cloud services.

🌐 **Live Demo:** [CampusCloud](https://shamee-cloudxyz.duckdns.org)  
📂 **GitHub Repository:** [CampusCloud-Student-Management-System](https://github.com/Shamee-tech/CampusCloud-Student-Management-System)

---

## 🚀 Project Overview

CampusCloud is a web-based application designed to manage student information and documents. It demonstrates the deployment of a PHP web application using AWS cloud infrastructure.

The project integrates Amazon EC2 for hosting, Amazon RDS for database management, and Amazon S3 for student document storage.

## ✨ Features

- Student record management
- Student document upload and download
- MySQL database integration
- Cloud-based document storage using Amazon S3
- HTTPS-secured web access
- Cloud-hosted application deployment

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| PHP 8.3 | Backend development |
| MySQL | Database management |
| HTML, CSS, JavaScript | Frontend development |
| Apache | Web server |
| Amazon EC2 | Application hosting |
| Amazon RDS | Managed MySQL database |
| Amazon S3 | Student document storage |
| AWS IAM Role | Secure AWS service access |
| DuckDNS | Domain name |
| Let's Encrypt | HTTPS certificate |
| Composer | PHP dependency management |
| Ubuntu 24.04 | Server operating system |

## ☁️ AWS Architecture

```text
                 Users
                   |
             HTTPS / Domain
                   |
          DuckDNS + Let's Encrypt
                   |
             Amazon EC2
          Ubuntu + Apache + PHP
             /           \
            /             \
   Amazon RDS MySQL     Amazon S3
   Student Database     Student Documents
```

### AWS Services

- **Amazon EC2:** Hosts the CampusCloud web application.
- **Amazon RDS:** Stores student management data in MySQL.
- **Amazon S3:** Stores uploaded student documents.
- **AWS IAM Role:** Allows the EC2 instance to access AWS services securely without hardcoding AWS credentials.

## 📂 Project Structure

```text
CampusCloud-Student-Management-System/
│
├── config/
│   └── config.example.php
│
├── database/
│
├── includes/
│
├── public/
│
├── scripts/
│
├── composer.json
├── composer.lock
├── .gitignore
└── README.md
```

## 🔐 Security

- Sensitive configuration files are excluded from GitHub.
- `.gitignore` is used to prevent accidental uploads of secret files.
- AWS access is managed using an IAM role.
- HTTPS is enabled for secure web access.
- Student documents are stored in Amazon S3.

> Please do not upload real student personal information, database passwords, AWS access keys, or private configuration files to this repository.

## ⚙️ Local Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/Shamee-tech/CampusCloud-Student-Management-System.git
   ```

2. Navigate to the project directory:

   ```bash
   cd CampusCloud-Student-Management-System
   ```

3. Install PHP dependencies:

   ```bash
   composer install
   ```

4. Create your local configuration file using `config/config.example.php`.

5. Configure your database connection and AWS settings using your own credentials.

6. Import the database schema from the `database` directory.

7. Configure your local Apache server to serve the application's `public` directory.

## 🎯 Learning Outcomes

This project provided practical experience with:

- Deploying a PHP application on AWS EC2
- Connecting an application to Amazon RDS
- Integrating Amazon S3 for document storage
- Configuring IAM roles for cloud access
- Setting up HTTPS for a web application
- Managing source code using Git and GitHub

## 👩‍💻 Author

**Shamee**

GitHub: [Shamee-tech](https://github.com/Shamee-tech)

---

⭐ If you find this project interesting, feel free to explore the repository!
