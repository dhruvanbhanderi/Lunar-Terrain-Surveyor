# Anand Watches - E-commerce Website

Anand Watches is a fully functional e-commerce website focused on selling watches. It is designed to provide a seamless experience for users, allowing them to browse products, register, log in, and manage their profile. The project utilizes front-end and back-end technologies to deliver a dynamic and interactive application.

---

## Features

### **Front-End**
- Developed using **HTML**, **CSS**, and **JavaScript**.
- Aesthetic design with:
  - Dark green background and dark blue buttons.
  - A clean and responsive layout.
- Navigation bar with options:
  - **Home**
  - **About Us**
  - **Categories**
  - **Contact Us**
  - Social media icons.
- **JavaScript**:
  - Input validation for forms (e.g., registration and login).
  - Interactive elements such as event listeners for form submissions.

### **Back-End**
- Powered by **PHP** to handle server-side logic and database interactions.
- Key functionalities:
  - **User authentication** (sign-up, login, password recovery).
  - File uploads (e.g., user profile pictures).
  - Session handling for user state and activity tracking.
  - CRUD operations to manage users, products, and document uploads.

### **Database**
- Implemented using **MySQL**, with the following tables:
  - **`student_login`**: Stores user login credentials.
    - Fields: `id`, `username`, `password`.
  - **`student_registration`**: Contains user profile information.
    - Fields: `id`, `name`, `email`, `contact_number`, `address`, `gender`, `dob`.
  - **`document_track`**: Tracks uploaded documents or files.
    - Fields: `id`, `user_id`, `document_name`, `upload_date`.

### **Session Management**
- Sessions are implemented using PHP's `$_SESSION`:
  - Tracks login state for users.
  - Counts the number of login attempts.
  - Maintains session-based data like cart items or page visits.

---

## Technologies Used

### **Languages**
- **HTML**: For structuring the website.
- **CSS**: For styling and layout.
- **JavaScript**: For client-side interactivity.
- **PHP**: For server-side scripting.
- **SQL**: For managing the database.

### **Tools and Frameworks**
- **PHPMyAdmin**: For managing the MySQL database.
- **WAMP Server/XAMPP**: To host the website locally.

---

## Application Workflow

### **1. User Registration**
- A sign-up page allows new users to register.
- JavaScript validates inputs for fields like email, password, and contact number.
- On successful registration, user details are saved in the `student_registration` table.

### **2. User Login**
- Registered users can log in via the login page.
- Passwords are verified against the `student_login` table.
- Invalid attempts are tracked using a session counter.

### **3. Forgot Password**
- Users can reset their passwords by verifying their email or other credentials.

### **4. Profile Management**
- Users can edit their profile information.
- Changes are updated in the `student_registration` table.

### **5. File Uploads**
- Users can upload documents or profile pictures.
- File details are stored in the `document_track` table.

---

## Database Details

### **Table: `student_login`**
| Field       | Type        | Description                    |
|-------------|-------------|--------------------------------|
| `id`        | INT         | Primary key, auto-incremented. |
| `username`  | VARCHAR(50) | Unique username for login.     |
| `password`  | VARCHAR(255)| Encrypted user password.       |

### **Table: `student_registration`**
| Field           | Type        | Description                              |
|------------------|-------------|------------------------------------------|
| `id`            | INT         | Primary key, auto-incremented.           |
| `name`          | VARCHAR(100)| Full name of the user.                   |
| `email`         | VARCHAR(100)| Unique email ID for registration.        |
| `contact_number`| VARCHAR(15) | User's contact number.                   |
| `address`       | TEXT        | User's residential address.              |
| `gender`        | ENUM('M','F')| Gender of the user.                     |
| `dob`           | DATE        | Date of birth of the user.               |

### **Table: `document_track`**
| Field           | Type        | Description                              |
|------------------|-------------|------------------------------------------|
| `id`            | INT         | Primary key, auto-incremented.           |
| `user_id`       | INT         | Foreign key referencing `student_login`. |
| `document_name` | VARCHAR(255)| Name of the uploaded document.           |
| `upload_date`   | TIMESTAMP   | Timestamp of the upload.                 |

---

## Setup Instructions

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/anand-watches.git
   cd anand-watches

2. **Set Up the Database**:
Open PHPMyAdmin and create a database (e.g., anand_watches).
Import the provided SQL file to set up the database tables.
Update the config.php file with your database credentials.

3. **Run the Application Locally**:
Start your local server (e.g., WAMP or XAMPP).
Place the project folder in the server's root directory (e.g., htdocs for XAMPP).
Open your browser and navigate to:
http://localhost/anand-watches/

4. **Explore the Website**:
Register as a new user.
Log in and explore the features.


