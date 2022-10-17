<?php
if (!isset($_SESSION['student_id'])) {
    header('location:' . SITEURL . 'index.php?page=login');;
}
