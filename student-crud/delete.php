<?php
/**
 * delete.php — ลบข้อมูลนักศึกษา (DELETE)
 * รับ id ผ่าน GET → ลบข้อมูล → redirect กลับ index.php
 * การยืนยันก่อนลบทำผ่าน JavaScript confirm() ที่ปุ่มลบใน index.php
 */

// เชื่อมต่อฐานข้อมูล
require_once __DIR__ . '/config/db.php';

// ตรวจสอบว่ามี id ส่งมาหรือไม่
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    // ถ้าไม่มี id → กลับหน้ารายชื่อ
    header('Location: index.php');
    exit;
}

// ตรวจสอบว่ามีข้อมูลนักศึกษาจริงก่อนลบ (ป้องกันลบ id ที่ไม่มีอยู่)
$stmt = $pdo->prepare("SELECT id FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);
$student = $stmt->fetch();

if (!$student) {
    // ไม่พบข้อมูล → กลับหน้ารายชื่อ
    header('Location: index.php');
    exit;
}

// ลบข้อมูลนักศึกษา (ใช้ Prepared Statement)
$stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
$stmt->execute([':id' => $id]);

// ลบสำเร็จ → redirect กลับหน้ารายชื่อพร้อมแจ้งเตือน
header('Location: index.php?success=deleted');
exit;
