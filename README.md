# Online Election Website

## 1. Project Overview
***
This project is a **web-based online election management system** designed to securely manage electoral data and user access. The application enables users to view election-related information while allowing administrators to manage and control electoral entities. The system follows a **role-based access control model**, ensuring that sensitive operations are restricted to authorized users only.

## 2. Project Objectives
***
The main objectives of this project are to **import electoral data from a CSV file into a relational database**, implement a **secure login system using sessions**, differentiate **user permissions based on roles (Admin vs Normal User)**, provide **full CRUD functionality for administrators**, and ensure **data integrity and consistency** throughout the application.

## 3. Core Features
***
**User Roles**
- **Normal User:** Secure login and read-only access to election data such as Qaza, lists, and candidates.
- **Administrator:** Secure admin access with extended privileges, including adding, editing, and deleting Qaza, lists, and candidates.

**Authentication & Security**
- Session-based authentication
- Role verification on protected pages
- Input validation and sanitization
- Restricted access to administrative features
- Password hashing for secure user authentication

## 4. Data Source & Storage
***
The application uses an initial **CSV file** containing structured election data, which is parsed and imported into a **relational database**. This approach ensures organized storage, efficient querying, and scalability. The database stores users, electoral regions (Qaza), lists, and candidates, reflecting real-world electoral relationships.

## 5. Database Structure (Simplified ERD Logic)
***
- A **Qaza** can contain multiple **Lists**
- A **List** can include multiple **Candidates**
- A **Candidate** belongs to exactly one **List**
- A **User** has a single role (Admin or Normal)

**Example Tables**
- **Users:** Username (PK), Password, Role  
- **Qaza:** Qaza_ID (PK), Qaza_Name  
- **Lists:** List_ID (PK), List_Name, List_Logo ,Qaza_ID (FK)  
- **Candidates:** Candidate_ID (PK), Candidate_Name, Candidate_DOB, Candidate_Sect, Candidate_Photo, List_ID (FK)

## 6. Technologies Used
***
- **Frontend:** HTML, CSS  
- **Backend:** PHP  
- **Database:** MySQL  
- **Data Handling:** CSV parsing  
- **Authentication:** PHP Sessions  

## 7. Setup & Usage
***
**Prerequisites:** PHP environment (XAMPP/WAMP/MAMP), MySQL, and a web browser.

**Installation Steps**
1. Clone the repository  
2. Place the project inside the web server directory  
3. Create a MySQL database and import the SQL schema  
4. Configure database credentials  
5. Import the CSV data into the database  
6. Start the server and access the application through the browser

## 8. Learning Outcomes
***
This project provided hands-on experience in **web application development**, **session management**, **role-based authorization**, **database design**, **CSV data integration**, and **secure CRUD operations**, reinforcing both backend and full-stack development concepts.
