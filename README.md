# 📚 ระบบจัดการนักศึกษา (Student CRUD System)

ระบบ CRUD (Create, Read, Update, Delete) สำหรับจัดการข้อมูลนักศึกษา
พัฒนาด้วย **PHP 8 + MySQL (PDO) + Bootstrap 5**

## ✨ ฟีเจอร์หลัก

- 📋 แสดงรายชื่อนักศึกษาทั้งหมดเป็นตาราง
- ➕ เพิ่มข้อมูลนักศึกษาใหม่ (พร้อม Validation)
- ✏️ แก้ไขข้อมูลนักศึกษา
- 🗑️ ลบข้อมูลนักศึกษา (มีการยืนยันก่อนลบ)
- 🛡️ ป้องกัน SQL Injection ด้วย Prepared Statement ทุกจุด

## 🛠️ เทคโนโลยีที่ใช้

| เทคโนโลยี | เวอร์ชัน |
|-----------|---------|
| PHP       | 8.x     |
| MySQL / MariaDB | 5.7+ / 10.x+ |
| Bootstrap | 5.3     |
| PDO       | (มากับ PHP) |

## 📦 วิธีติดตั้งและใช้งาน

### 1. เตรียมเครื่องมือ

ติดตั้ง **XAMPP** หรือ **Laragon** ที่มี PHP 8 และ MySQL/MariaDB

### 2. นำโค้ดเข้าเครื่อง

คัดลอกโฟลเดอร์ `student-crud` ไปไว้ใน:
- **XAMPP**: `C:\xampp\htdocs\student-crud\`
- **Laragon**: `C:\laragon\www\student-crud\`

### 3. สร้างฐานข้อมูล

1. เปิด **phpMyAdmin** (http://localhost/phpmyadmin)
2. คลิกแท็บ **Import**
3. เลือกไฟล์ `database/schema.sql`
4. คลิก **Go** เพื่อ import

หรือใช้ MySQL CLI:
```bash
mysql -u root -p < database/schema.sql
```

### 4. ตั้งค่าการเชื่อมต่อฐานข้อมูล

แก้ไขไฟล์ `config/db.php` ให้ตรงกับเครื่องของคุณ:

```php
$host     = 'localhost';
$dbname   = 'student_crud';
$username = 'root';       // ชื่อผู้ใช้ MySQL
$password = '';           // รหัสผ่าน (XAMPP ปกติเว้นว่าง)
```

### 5. เปิดใช้งาน

เปิดเบราว์เซอร์แล้วเข้า:
```
http://localhost/student-crud/
```

## 📁 โครงสร้างไฟล์

```
student-crud/
├── config/
│   └── db.php              # เชื่อมต่อฐานข้อมูลด้วย PDO
├── database/
│   └── schema.sql           # คำสั่งสร้างตาราง + ข้อมูลตัวอย่าง
├── includes/
│   ├── header.php           # ส่วนหัว + Navbar (Bootstrap 5)
│   └── footer.php           # ส่วนท้าย
├── index.php                # READ: แสดงรายชื่อนักศึกษา
├── create.php               # CREATE: เพิ่มนักศึกษาใหม่
├── edit.php                 # UPDATE: แก้ไขข้อมูล
├── delete.php               # DELETE: ลบข้อมูล
├── .gitignore
└── README.md
```

## 🔒 ความปลอดภัย

- ใช้ **PDO Prepared Statement** ทุกจุดที่มีการ query ฐานข้อมูล
- ใช้ `htmlspecialchars()` ป้องกัน XSS เมื่อแสดงผลข้อมูล
- Validate ข้อมูล input ทุกฟอร์มฝั่ง server ก่อนบันทึก

## 👨‍🏫 สำหรับผู้สอน

โปรเจกต์นี้ออกแบบเพื่อการเรียนรู้ เหมาะสำหรับนักศึกษาชั้นปี 3 สาขาเทคโนโลยีสารสนเทศ
ที่ต้องการเรียนรู้ PHP + MySQL CRUD แบบ native (ไม่ใช้ Framework)
