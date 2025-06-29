CREATE DATABASE IF NOT EXISTS fitzone;
USE fitzone;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('customer', 'staff', 'admin') DEFAULT 'customer'
);

CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT
);

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    class_id INT,
    date DATE,
    time TIME,
    message TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (class_id) REFERENCES classes(id)
);

CREATE TABLE queries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO classes (name, description) VALUES
('Cardio', 'Heart-pumping aerobic sessions'),
('Strength Training', 'Build your strength'),
('Yoga', 'Flexibility and mindfulness');
