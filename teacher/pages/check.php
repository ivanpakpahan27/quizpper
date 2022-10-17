<?php
if (!isset($_SESSION['teacher_id'])) {
    $_SESSION['xss'] = "<div class='error'>Please login to access control panel</div>";
    header('location:' . SITEURL . 'teacher/index.php?page=login');
}
