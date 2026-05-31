-- =========================================================================
-- medizen_db.sql
-- Minimal database setup for the foundation PR.
-- This just creates the database and a small test table so we can verify
-- the DB connection is working end-to-end via apply.php.
--
-- Real tables (eoi, members, jobs, managers) will be added by their
-- owners in their own PRs.
-- =========================================================================

-- 1. Create the database (no password on local XAMPP, per brief)
CREATE DATABASE IF NOT EXISTS medizen_db
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE medizen_db;

-- =========================================================================
-- 2. Temporary test table - lets apply.php prove the DB connection works.
-- This table will be removed before final submission once real tables exist.
-- =========================================================================
CREATE TABLE IF NOT EXISTS test_messages (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(50) NOT NULL,
    message     VARCHAR(200),
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL
);

INSERT INTO users (id, username, password) VALUES (NULL, 'admin', '$2y$10$ktbEFmsKwNuhAxJkGzcM/.gbfiDE6cyitvAvInpuOE7LAaf0SarHy');
-- =========================================================================
-- TODO: real tables (added by each owner in their own PRs)
-- =========================================================================
-- TODO Kevin (Task 3) - eoi table with all 15 skill columns and
--                       status ENUM('New','Current','Final')

DROP TABLE IF EXISTS eoi;
CREATE TABLE eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_reference CHAR(5) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    street_address VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state VARCHAR(3) NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(80) NOT NULL,
    phone VARCHAR(12) NOT NULL,
    skill_medical_terminology BOOLEAN DEFAULT FALSE, 
    skill_health_safety BOOLEAN DEFAULT FALSE, 
    skill_infection_control BOOLEAN DEFAULT FALSE, 
    skill_documentation BOOLEAN DEFAULT FALSE, 
    skill_patient_workflows BOOLEAN DEFAULT FALSE, 
    skill_office_workspace BOOLEAN DEFAULT FALSE, 
    skill_cybersecurity BOOLEAN DEFAULT FALSE, 
    skill_data_entry BOOLEAN DEFAULT FALSE, 
    skill_ehr_systems BOOLEAN DEFAULT FALSE, 
    skill_scheduling_systems BOOLEAN DEFAULT FALSE, 
    skill_first_aid BOOLEAN DEFAULT FALSE, 
    skill_customer_service BOOLEAN DEFAULT FALSE, 
    skill_healthcare_wellness BOOLEAN DEFAULT FALSE, 
    skill_multilingual BOOLEAN DEFAULT FALSE, 
    skill_knowledge_nutrition BOOLEAN DEFAULT FALSE, 
    other_skills TEXT,
    status VARCHAR(10) DEFAULT 'New',
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TODO Elliot (Task 7) - members table with contribution_part1 and
--                      contribution_part2 columns
DROP TABLE IF EXISTS members;
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    student_id VARCHAR(20) NOT NULL,
    quote VARCHAR(255),
    quote_language VARCHAR(50),
    quote_english VARCHAR(255),
    contribution_project1 TEXT,
    contribution_project2 TEXT
);

INSERT INTO members (name, student_id, quote, quote_language, quote_english, contribution_project1, contribution_project2)
VALUES 
('Elliot Caval', '106513795', 'Nama saya Elliot', 'Indonesian', 'My name is Elliot', 'Developed index.html, about.html, set up the project structure, and created the shared header and footer.', 'Your project 2 contribution here'),
('Jaxon Del Mastro', '106523532', 'Guten Morgen', 'German', 'Good morning', 'Developed apply.html and jobs.html.', 'Your project 2 contribution here'),
('Cheoum Lee (Kevin)', '106523655', '티끌 모아 태산', 'Korean', 'Many small drops make a mighty ocean', 'Refactored about.html to meet all brief requirements, wrote the page CSS styling, and ran HTML5 and accessibility validation.', 'Your project 2 contribution here');


DROP TABLE IF EXISTS jobs;
CREATE TABLE `jobs` (
  id varchar(5) NOT NULL PRIMARY KEY,
  name varchar(50) NOT NULL,
  description text NOT NULL,
  responsibilities text NOT NULL,
  requirements text NOT NULL,
  salary int(11) NOT NULL,
  reports_to varchar(50) NOT NULL
);

INSERT INTO `jobs` (`id`, `name`, `description`, `responsibilities`, `requirements`, `salary`, `reports_to`) VALUES
('H5C7B', 'Digital wellness consultant', 'As the digital wellness consultant at mediZen you will act as the face of the company. This position will consist of supporting our clients with all of there health and wellness needs in a professional manner that builds trust in our brand. compassion and interest in helping the wellbeing of otheres is of the highest priority as it is important in assuring the integrity of out services.', 'Provide virtual consultations via video, chat, or phone|Develop personalised wellness plans and goals|Monitor client progress using digital tracking tools|Ensure compliance with privacy and healthcare regulations|', 'Strong communication and interpersonal skills|Empathy and active listening|Understanding of health and wellness principles|', 9000, 'Wellness Program Manager'),
('JB235', 'Client data entry', 'A Client Data Entry Officer is responsible for accurately inputting, updating, and maintaining client information within digital systems. This role ensures that all records are complete, secure, and accessible to support efficient service delivery.', 'Enter client information into databases and digital systems|Update and maintain accurate client records|Organise and manage digital files and documents|Identify and correct data errors|', 'High attention to detail|Fast and accurate typing skills|Basic computer and data management skills|', 8000, 'Client data Manager');

-- TODO Jaxon (Task 5)  - jobs table with separate fields (per rubric)
-- TODO Jaxon (Task 6)  - managers table with hashed passwords
