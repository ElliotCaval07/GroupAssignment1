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

CREATE TABLE IF NOT EXISTS user (
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL
);
-- =========================================================================
-- TODO: real tables (added by each owner in their own PRs)
-- =========================================================================
-- TODO Kevin (Task 3) - eoi table with all 15 skill columns and
--                       status ENUM('New','Current','Final')
-- TODO Elliot (Task 7) - members table with contribution_part1 and
--                        contribution_part2 columns
-- TODO Jaxon (Task 5)  - jobs table with separate fields (per rubric)
-- TODO Jaxon (Task 6)  - managers table with hashed passwords
