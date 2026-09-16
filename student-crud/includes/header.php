<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการนักศึกษา</title>
    <!-- Bootstrap 5 CSS จาก CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YcnS49V4FxIkMnm9UT1z3ws9sl0OSn5hvp6"
          crossorigin="anonymous">
    <!-- Bootstrap Icons (ใช้ไอคอนต่างๆ ในปุ่ม) -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <!-- แถบเมนูด้านบน (Navbar) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-mortarboard-fill me-2"></i>ระบบจัดการนักศึกษา
            </a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-list-ul me-1"></i>รายชื่อ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">
                            <i class="bi bi-person-plus me-1"></i>เพิ่มนักศึกษา
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- เริ่มเนื้อหาหลัก -->
    <div class="container">
