-- ============================================================
-- schema.sql — สร้างฐานข้อมูลและตาราง students
-- ใช้สำหรับ import ผ่าน phpMyAdmin หรือ MySQL CLI
-- ============================================================

-- สร้างฐานข้อมูล (ถ้ายังไม่มี)
CREATE DATABASE IF NOT EXISTS student_crud
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- เลือกใช้ฐานข้อมูลที่เพิ่งสร้าง
USE student_crud;

-- ลบตารางเดิมถ้ามี (ใช้ตอน dev เท่านั้น)
DROP TABLE IF EXISTS students;

-- สร้างตาราง students
CREATE TABLE students (
    id          INT             AUTO_INCREMENT PRIMARY KEY   COMMENT 'รหัสอัตโนมัติ',
    student_id  VARCHAR(10)     NOT NULL UNIQUE              COMMENT 'รหัสนักศึกษา',
    first_name  VARCHAR(100)    NOT NULL                     COMMENT 'ชื่อ',
    last_name   VARCHAR(100)    NOT NULL                     COMMENT 'นามสกุล',
    major       VARCHAR(100)    NOT NULL                     COMMENT 'สาขาวิชา',
    year        INT             NOT NULL                     COMMENT 'ชั้นปี (1-4)',
    created_at  TIMESTAMP       DEFAULT CURRENT_TIMESTAMP    COMMENT 'วันที่สร้างรายการ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- ข้อมูลตัวอย่าง 5 รายการ
-- ============================================================
INSERT INTO students (student_id, first_name, last_name, major, year) VALUES
    ('6501001', 'สมชาย',   'ใจดี',       'เทคโนโลยีสารสนเทศ',     3),
    ('6501002', 'สมหญิง',  'รักเรียน',    'วิทยาการคอมพิวเตอร์',    2),
    ('6501003', 'อนุชา',   'สุขสันต์',    'เทคโนโลยีสารสนเทศ',     3),
    ('6501004', 'พรรณี',   'มั่นคง',      'วิศวกรรมซอฟต์แวร์',      4),
    ('6501005', 'กิตติ',   'เก่งมาก',     'เทคโนโลยีสารสนเทศ',     1);
