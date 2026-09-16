<?php
/**
 * create.php — ฟอร์มเพิ่มข้อมูลนักศึกษาใหม่ (CREATE)
 * มี validate ฝั่ง server ทุกฟิลด์ ห้ามเว้นว่าง
 */

// เชื่อมต่อฐานข้อมูล
require_once __DIR__ . '/config/db.php';

// ตัวแปรเก็บ error และค่าจากฟอร์ม (เพื่อแสดงค่าเดิมเมื่อ validate ไม่ผ่าน)
$errors = [];
$student_id = '';
$first_name = '';
$last_name  = '';
$major      = '';
$year       = '';

// ตรวจสอบว่าเป็นการ submit ฟอร์มหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // รับค่าจากฟอร์มและตัดช่องว่างหัวท้าย
    $student_id = trim($_POST['student_id'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name']  ?? '');
    $major      = trim($_POST['major']      ?? '');
    $year       = trim($_POST['year']       ?? '');

    // === Validation: ตรวจสอบข้อมูลก่อนบันทึก ===
    if ($student_id === '') {
        $errors[] = 'กรุณากรอกรหัสนักศึกษา';
    } elseif (mb_strlen($student_id) > 10) {
        $errors[] = 'รหัสนักศึกษาต้องไม่เกิน 10 ตัวอักษร';
    }

    if ($first_name === '') {
        $errors[] = 'กรุณากรอกชื่อ';
    }

    if ($last_name === '') {
        $errors[] = 'กรุณากรอกนามสกุล';
    }

    if ($major === '') {
        $errors[] = 'กรุณากรอกสาขาวิชา';
    }

    if ($year === '') {
        $errors[] = 'กรุณาเลือกชั้นปี';
    } elseif (!in_array((int)$year, [1, 2, 3, 4])) {
        $errors[] = 'ชั้นปีต้องเป็น 1-4 เท่านั้น';
    }

    // ถ้าไม่มี error → บันทึกลงฐานข้อมูล
    if (empty($errors)) {
        try {
            // ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
            $sql = "INSERT INTO students (student_id, first_name, last_name, major, year)
                    VALUES (:student_id, :first_name, :last_name, :major, :year)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':student_id' => $student_id,
                ':first_name' => $first_name,
                ':last_name'  => $last_name,
                ':major'      => $major,
                ':year'       => (int)$year,
            ]);

            // บันทึกสำเร็จ → redirect กลับหน้ารายชื่อ
            header('Location: index.php?success=created');
            exit;

        } catch (PDOException $e) {
            // ตรวจจับ error duplicate student_id (error code 23000)
            if ($e->getCode() == 23000) {
                $errors[] = "รหัสนักศึกษา \"{$student_id}\" ซ้ำกับที่มีอยู่แล้ว";
            } else {
                $errors[] = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล: ' . $e->getMessage();
            }
        }
    }
}

// โหลดส่วนหัว
require_once __DIR__ . '/includes/header.php';
?>

<h1 class="mb-4"><i class="bi bi-person-plus-fill me-2"></i>เพิ่มนักศึกษาใหม่</h1>

<?php if (!empty($errors)): ?>
    <!-- แสดงรายการ error ทั้งหมด -->
    <div class="alert alert-danger">
        <strong><i class="bi bi-exclamation-triangle me-1"></i>พบข้อผิดพลาด:</strong>
        <ul class="mb-0 mt-2">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- ฟอร์มเพิ่มข้อมูล -->
<form action="create.php" method="POST" novalidate>

    <div class="mb-3">
        <label for="student_id" class="form-label">รหัสนักศึกษา <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="student_id" name="student_id"
               value="<?= htmlspecialchars($student_id); ?>"
               maxlength="10" placeholder="เช่น 6501001" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="first_name" class="form-label">ชื่อ <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="first_name" name="first_name"
                   value="<?= htmlspecialchars($first_name); ?>"
                   maxlength="100" placeholder="เช่น สมชาย" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="last_name" class="form-label">นามสกุล <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="last_name" name="last_name"
                   value="<?= htmlspecialchars($last_name); ?>"
                   maxlength="100" placeholder="เช่น ใจดี" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="major" class="form-label">สาขาวิชา <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="major" name="major"
               value="<?= htmlspecialchars($major); ?>"
               maxlength="100" placeholder="เช่น เทคโนโลยีสารสนเทศ" required>
    </div>

    <div class="mb-3">
        <label for="year" class="form-label">ชั้นปี <span class="text-danger">*</span></label>
        <select class="form-select" id="year" name="year" required>
            <option value="">-- เลือกชั้นปี --</option>
            <option value="1" <?= ($year === '1') ? 'selected' : ''; ?>>ปี 1</option>
            <option value="2" <?= ($year === '2') ? 'selected' : ''; ?>>ปี 2</option>
            <option value="3" <?= ($year === '3') ? 'selected' : ''; ?>>ปี 3</option>
            <option value="4" <?= ($year === '4') ? 'selected' : ''; ?>>ปี 4</option>
        </select>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i>บันทึก
        </button>
        <a href="index.php" class="btn btn-secondary ms-2">
            <i class="bi bi-x-circle me-1"></i>ยกเลิก
        </a>
    </div>

</form>

<?php
// โหลดส่วนท้าย
require_once __DIR__ . '/includes/footer.php';
?>
