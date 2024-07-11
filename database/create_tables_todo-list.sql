
-- Drop tables if they exist
DROP TABLE IF EXISTS reminders;
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS lists;
DROP TABLE IF EXISTS users;


-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    avatar_image VARCHAR(200),
    email VARCHAR(200) NOT NULL,
    registration_date DATE NOT NULL
);

-- Lists Table (or Categories)
CREATE TABLE lists (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL,
    list_color VARCHAR(50)
);

-- Tasks Table
CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(300),
    description TEXT,
    user_id INT,
    list_order INT DEFAULT 1,
    list_id INT,
    creation_date DATE NOT NULL,
    due_date DATE,
    completed BOOLEAN DEFAULT false,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (list_id) REFERENCES lists(id)
);


-- Reminders Table
CREATE TABLE reminders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    task_id INT,
    reminder_time DATETIME,
    repeat_interval INT DEFAULT NULL, -- interval for repeat in days
    repeat_end_date DATE DEFAULT NULL, -- end date for repeating reminders
    FOREIGN KEY (task_id) REFERENCES tasks(id)
);
