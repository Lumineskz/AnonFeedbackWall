# Anonymous Feedback Wall
![Banner](https://github.com/Lumineskz/AnonFeedbackWall/tree/main/Code/assets/banner.png)  
*A simple and secure platform for sharing thoughts without revealing identity.*

---
### ✨ Overview
- This project is a simple, modern, and anonymous Feedback Wall application. It allows users to post feedback, comments, or suggestions, with the option to remain completely anonymous or display their chosen username. Built using a standard web stack (HTML, CSS, JS, PHP, and a database), it provides a functional and secure way to gather user input.
---
### 🚀 Features
- Anonymous Posting: Users can choose to hide their username and post feedback anonymously.
- Username Display: Users have the option to provide a username that will be displayed with their feedback.
- Modern UI: A clean and responsive user interface designed with HTML and CSS.
- Client-Side Validation: Basic form validation handled by JavaScript.
- Server-Side Processing: Secure handling and storage of feedback using PHP.
- Time/Date Stamping: Each post is automatically stamped with the date and time it was submitted.
---
### 💻 Technologies Used
- Category	Technology	Description
- Frontend	HTML5	Structure and content of the application.
- Styling	CSS3	Presentation and responsiveness.
- Interactivity	JavaScript (ES6+)	Client-side logic and form handling.
- Backend	PHP	Server-side logic for processing and storing feedback.
- Database	MySQL / SQLite	Storage for the feedback posts.
---
### 🛠️ Installation and Setup
### Prerequisites
You will need a local server environment (like XAMPP, MAMP, or WAMP) with PHP and your chosen Database running.
1. Clone the Repository
git clone https://github.com/YourUsername/AnonFeedbackWall.git
cd anonymous-feedback-wall
2. Database Setup
Create a Database: Open phpMyAdmin and create a new database (e.g., feedback_db).
Run the following SQL query to create the feedback table:
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NULL,
    content TEXT NOT NULL,
    is_anonymous BOOLEAN NOT NULL DEFAULT 0,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
3. Configure Database Connection (PHP)
<?php
// Example PHP configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'feedback_db');
?>
4. Run the Application
Place the project folder into your web server's root directory (e.g., htdocs for XAMPP). Then visit: http://localhost/anonymous-feedback-wall/

### 📝 Usage
- Open the page: Navigate to the main index file.
- Enter Feedback: Type your comment or suggestion into the input area.
- Choose Identity: Leave username blank for anonymous posting, or fill it in to post with a name.
- Submit: Click the 'Post Feedback' button.
---
### 🤝 Contributing
Contributions are always welcome!
1. Fork the Project
2. Create your Feature Branch (git checkout -b feature/AmazingFeature)
3. Commit your Changes (git commit -m 'Add some AmazingFeature')
4. Push to the Branch (git push origin feature/AmazingFeature)
5. Open a Pull Request.
---
### 📜 License
Distributed under the MIT License. See LICENSE for more information.
---
### 📧 Contact
Shulabh Shrestha - shubhamsulabh6@gmail.com
Project Link: https://github.com/Lumineskz/AnonFeedbackWall/
