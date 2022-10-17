<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'dashboard';
}

switch ($page) {
    case "dashboard": {
            include('dashboard.php');
        }
        break;

    case "users": {
            include('users.php');
        }
        break;

    case "add_user": {
            include('add_user.php');
        }
        break;

    case "update_user": {
            include('add_user.php');
        }
        break;

    case "students": {
            include('students.php');
        }
        break;

    case "add_student": {
            include('add_student.php');
        }
        break;

    case "update_student": {
            include('update_student.php');
        }
        break;

    case "subjects": {
            include('subjects.php');
        }
        break;

    case "add_subject": {
            include('add_subject.php');
        }
        break;

    case "update_subject": {
            include('update_subject.php');
        }
        break;

    case "questions": {
            include('questions.php');
        }
        break;

    case "add_question": {
            include('add_question.php');
        }
        break;

    case "update_question": {
            include('update_question.php');
        }
        break;

    case "results": {
            include('results.php');
        }
        break;

    case "view_result": {
            include('view_result.php');
        }
        break;

    case "settings": {
            include('settings.php');
        }
        break;

    case "login": {
            include('login.php');
        }
        break;

    case "logout": {
            if (isset($_SESSION['teacher_id'])) {
                unset($_SESSION['teacher_id']);
                header('location:' . SITEURL . 'teacher/index.php?page=login');
            }
        }
        break;

    default: {
            include('dashboard.php');
        }
}
