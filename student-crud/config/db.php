<?php
/**
 * db.php — ไฟล์เชื่อมต่อฐานข้อมูล MySQL ด้วย PDO
 * ไฟล์อื่นทั้งหมดจะ include ไฟล์นี้เพื่อใช้ตัวแปร $pdo
 */

// ตั้งค่าการเชื่อมต่อ — แก้ไขให้ตรงกับเครื่องของคุณ
$host     = 'localhost';   // ชื่อ host ของ MySQL
$dbname   = 'student_crud'; // ชื่อฐานข้อมูล (ต้องตรงกับใน schema.sql)
$username = 'root';         // ชื่อผู้ใช้ MySQL (XAMPP/Laragon ค่าเริ่มต้นคือ root)
$password = '';             // รหัสผ่าน (XAMPP ปกติเว้นว่าง)
$charset  = 'utf8mb4';     // รองรับภาษาไทยและอีโมจิ

// สร้าง DSN (Data Source Name) สำหรับ PDO
$dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";

// ตัวเลือกของ PDO — ตั้งค่าให้ปลอดภัยและใช้งานง่าย
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // แสดง error เป็น Exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // ดึงข้อมูลเป็น associative array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // ใช้ prepared statement จริง
];

// ลองเชื่อมต่อฐานข้อมูล — ถ้าเชื่อมไม่ได้จะแจ้ง error
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // แสดงข้อความ error — ในระบบจริงไม่ควรแสดง $e->getMessage() ให้ผู้ใช้เห็น
    die("❌ เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage());
}
