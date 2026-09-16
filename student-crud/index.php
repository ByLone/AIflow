<?php
/**
 * index.php — หน้าแสดงรายชื่อนักศึกษาทั้งหมด (READ)
 * ดึงข้อมูลจากตาราง students แล้วแสดงเป็นตาราง Bootstrap
 */

// เชื่อมต่อฐานข้อมูล
require_once __DIR__ . '/config/db.php';

// ดึงข้อมูลนักศึกษาทั้งหมด เรียงตาม id ล่าสุดก่อน
$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();

// รับข้อความแจ้งเตือนจากหน้าอื่น (ถ้ามี)
$success = $_GET['success'] ?? '';

// โหลดส่วนหัว
require_once __DIR__ . '/includes/header.php';
?>

<!-- หัวข้อหน้าและปุ่มเพิ่มนักศึกษา -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1><i class="bi bi-people-fill me-2"></i>รายชื่อนักศึกษา</h1>
    <a href="create.php" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>เพิ่มนักศึกษาใหม่
    </a>
</div>

<?php if ($success === 'created'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>เพิ่มข้อมูลนักศึกษาสำเร็จ!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php elseif ($success === 'updated'): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>แก้ไขข้อมูลนักศึกษาสำเร็จ!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php elseif ($success === 'deleted'): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-trash me-1"></i>ลบข้อมูลนักศึกษาสำเร็จ!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (count($students) > 0): ?>
    <!-- ตารางแสดงข้อมูล -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>รหัสนักศึกษา</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>สาขาวิชา</th>
                    <th>ชั้นปี</th>
                    <th>วันที่เพิ่ม</th>
                    <th class="text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $index => $row): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($row['student_id']); ?></td>
                    <td><?= htmlspecialchars($row['first_name']); ?></td>
                    <td><?= htmlspecialchars($row['last_name']); ?></td>
                    <td><?= htmlspecialchars($row['major']); ?></td>
                    <td><span class="badge bg-secondary">ปี <?= (int)$row['year']; ?></span></td>
                    <td><?= htmlspecialchars($row['created_at']); ?></td>
                    <td class="text-center">
                        <!-- ปุ่มแก้ไข -->
                        <a href="edit.php?id=<?= (int)$row['id']; ?>"
                           class="btn btn-warning btn-sm me-1"
                           title="แก้ไข">
                            <i class="bi bi-pencil-square"></i> แก้ไข
                        </a>
                        <!-- ปุ่มลบ — ใช้ onclick confirm ก่อนลบ -->
                        <a href="delete.php?id=<?= (int)$row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           title="ลบ"
                           onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบนักศึกษาคนนี้?');">
                            <i class="bi bi-trash"></i> ลบ
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <!-- กรณีไม่มีข้อมูล -->
    <div class="alert alert-info text-center">
        <i class="bi bi-info-circle me-1"></i>ยังไม่มีข้อมูลนักศึกษา
        <a href="create.php" class="alert-link">คลิกที่นี่เพื่อเพิ่ม</a>
    </div>
<?php endif; ?>

<?php
// โหลดส่วนท้าย
require_once __DIR__ . '/includes/footer.php';
?>
