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
--                        contribution_part2 columns
-- TODO Jaxon (Task 5)  - jobs table with separate fields (per rubric)
-- TODO Jaxon (Task 6)  - managers table with hashed passwords
