CREATE DATABASE IF NOT EXISTS psp_student_portal;
USE psp_student_portal;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    ic VARCHAR(30) NOT NULL UNIQUE,
    program VARCHAR(100) NOT NULL,
    marks INT NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO students (name, ic, program, marks, password)
VALUES
('Guthrie Brayan Raj', '10DIT23F2033', 'Diploma in Information Technology', 90, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC8Z1v1R2H8H4G8aX0a');
