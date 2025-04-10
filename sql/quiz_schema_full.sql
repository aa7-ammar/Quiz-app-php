
-- Create users table
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
);

-- Create questions table
CREATE TABLE `questions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `question_text` TEXT NOT NULL,
  `option_a` VARCHAR(255) NOT NULL,
  `option_b` VARCHAR(255) NOT NULL,
  `option_c` VARCHAR(255) NOT NULL,
  `option_d` VARCHAR(255) NOT NULL,
  `correct_option` VARCHAR(1) NOT NULL
);

-- Create answers table
CREATE TABLE `answers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `question_id` INT NOT NULL,
  `selected_option` VARCHAR(1) NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`)
);

-- Insert sample CSE quiz questions
INSERT INTO `questions` (`question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
('What is the time complexity of merge sort?', 'O(n)', 'O(n log n)', 'O(n^2)', 'O(log n)', 'B'),
('Which data structure uses FIFO?', 'Stack', 'Queue', 'Tree', 'Graph', 'B'),
('Which layer of the OSI model handles routing?', 'Transport', 'Network', 'Session', 'Data Link', 'B'),
('What does SQL stand for?', 'Structured Query Language', 'Sequential Query Logic', 'Simple Query Language', 'None of the above', 'A'),
('What is a foreign key in SQL?', 'A unique key in a table', 'A key from another table', 'The main key of a table', 'A key that can be NULL', 'B'),
('Which protocol is used to transfer web pages?', 'FTP', 'SMTP', 'HTTP', 'SSH', 'C'),
('What is the output of: print(2 ** 3) in Python?', '6', '8', '9', '5', 'B'),
('Which of these is NOT a programming language?', 'Python', 'HTML', 'Java', 'C++', 'B'),
('Which keyword is used to create a class in Java?', 'function', 'define', 'class', 'new', 'C'),
('Which of these is a NoSQL database?', 'MySQL', 'PostgreSQL', 'MongoDB', 'Oracle', 'C');