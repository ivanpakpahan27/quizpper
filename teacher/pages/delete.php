<?php
include('../config/apply.php');

if (isset($_POST['delete_question'])) {
    $page = 'questions';
    $question_id = $_POST['question_id'];
    $tbl_name = "tbl_question";
    $where = "question_id=$question_id";
    //Query to Delete
    $query = $obj->delete_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    if ($res == true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>" . $title . " Berhasil menghapus!.</div>";
        header('location:' . SITEURL . 'teacher/index.php?page=' . $page);
    } else {
        $_SESSION['delete'] = "<div class='alert alert-error'>Gagal menghapus!. " . $title . ".</div>";
        header('location:' . SITEURL . 'teacher/index.php?page=' . $page);
    }
} elseif (isset($_POST['delete_subject'])) {
    $page = 'subjects';
    $subject_id = $_POST['subject_id'];
    $tbl_name = "tbl_subject";
    $where = "subject_id=$subject_id";
    //Query to Delete
    $query = $obj->delete_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    if ($res == true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>" . $title . " Berhasil menghapus!.</div>";
        header('location:' . SITEURL . 'teacher/index.php?page=' . $page);
    } else {
        $_SESSION['delete'] = "<div class='alert alert-error'>Gagal menghapus" . $title . ".</div>";
        header('location:' . SITEURL . 'teacher/index.php?page=' . $page);
    }
} elseif (isset($_POST['delete_student'])) {
    $page = 'students';
    $student_id = $_POST['student_id'];
    $tbl_name = "tbl_student";
    $where = "student_id=$student_id";
    //Query to Delete
    $query = $obj->delete_data($tbl_name, $where);
    $res = $obj->execute_query($conn, $query);
    if ($res == true) {
        $_SESSION['delete'] = "<div class='alert alert-success'>" . $title . " Berhasil menghapus!.</div>";
        header('location:' . SITEURL . 'teacher/index.php?page=' . $page);
    } else {
        $_SESSION['delete'] = "<div class='alert alert-error'>Gagal menghapus! " . $title . ".</div>";
        header('location:' . SITEURL . 'teacher/index.php?page=' . $page);
    }
}
