<?php
if (!isset($_SESSION['teacher_id'])) {
    $_SESSION['xss'] = "<div class='alert alert-info alert-dismissible fade show'>Silahkan Login, Untuk Akses Panel Kontrol.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    header('location:' . SITEURL . 'teacher/index.php?page=login');
}
